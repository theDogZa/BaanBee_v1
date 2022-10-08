<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

use App;
use App\Models;
use App\Models\Item_adjusted;
use Session;
use Cache;

use DB;

class Item_adjustedsController extends Controller
{
    public function __construct()
    {
		$this->middleware(['auth', 'lock']);
		Cache::flush();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header('Content-Type: text/html');

		$this->arrShowFieldIndex = [
		 'date' => 1,  'doc_num' => 1,  'adjusted_status' => 1,  'adjusted_desc' => 1,  'active' => 1, 	
		];
		$this->arrShowFieldFrom = [
		 'date' => 1,  'doc_num' => 1,  'adjusted_status' => 1,  'adjusted_desc' => 1,  'active' => 1, 
		];
		$this->arrShowFieldView = [
		 'date' => 1,  'doc_num' => 1,  'adjusted_status' => 1,  'adjusted_desc' => 1,  'active' => 1, 	
		];

												
		//arr val for adjusted_status to Radio, CheckBox and Select
		$this->arradjusted_status = ['1','2'];
												
	}
	
	/**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
		$rules = [
			'date' => 'required|string|max:255',
			'doc_num' => 'required|string|max:255',
			//#Ex
			//'username' => 'required|string|max:20|unique:users,username,' . $data ['id'],
			//'email' => 'required|string|email|max:255|unique:users,email,' . $data ['id'],
			// 'password' => 'required|string|min:6|confirmed',
			//'password' => 'required|string|min:6',
		];
		
		$messages = [
			'date.required' => trans('Item_adjusted.date_required'),
			'doc_num.required' => trans('Item_adjusted.doc_num_required'),
			//#Ex
			//'email.unique'  => 'Email already taken' ,
			//'username.unique'  => 'Username "' . $data['username'] . '" already taken',
			//'email.email' =>'Email type',
		];

		return Validator::make($data,$rules,$messages);
	}


    public function index(Request $request)
	{
		$select = _listToSelect($this->arrShowFieldIndex);

		if (@$request->all()) {
			if (@$request->input('search')) {
				$search = $request->input('search');
				$results = Item_adjusted::select($select);
				//->join('tableA', 'item_adjusteds.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'item_adjusteds.tableB_id', '=', 'tableB.id')
				
				(!empty($this->arrShowFieldIndex['date'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_adjusteds.date', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['doc_num'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_adjusteds.doc_num', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['adjusted_status'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_adjusteds.adjusted_status', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['adjusted_desc'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_adjusteds.adjusted_desc', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['active'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_adjusteds.active', 'LIKE','%'. @$search.'%') : "" ;
				//$results = is_null ($search) ? $results : $results->orWhere ('tableA.columnName', 'LIKE','%'. @$search.'%') ;
				$results = $results->sortable()
				->paginate(config('core.paginate'));

			}else{

				$results = Item_adjusted::select($select);
				//->join('tableA', 'item_adjusteds.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'item_adjusteds.tableB_id', '=', 'tableB.id')
				//->select('item_adjusteds.*', 'tableA.columnName', 'tableB.columnName');
				(!empty( $this->arrShowFieldIndex['doc_num'] ))? $results = is_null ($request->input ('doc_num')) ? $results : $results->Where ('Item_adjusteds.doc_num', 'LIKE', @$request->input ('doc_num')) : "" ;
				(!empty( $this->arrShowFieldIndex['adjusted_status'] ))? $results = is_null ($request->input ('adjusted_status')) ? $results : $results->Where('Item_adjusteds.adjusted_status', '=', @$request->input ('adjusted_status')) : "" ;
				(!empty( $this->arrShowFieldIndex['adjusted_desc'] ))? $results = is_null ($request->input ('adjusted_desc')) ? $results : $results->Where ('Item_adjusteds.adjusted_desc', 'LIKE', @$request->input ('adjusted_desc')) : "" ;
				(!empty( $this->arrShowFieldIndex['active'] ))? $results = is_null ($request->input ('active')) ? $results : $results->Where('Item_adjusteds.active', '=', @$request->input ('active')) : "" ;
				(!empty( $this->arrShowFieldIndex['date'] ))? $results = is_null ($request->input ('date_start')) ? (is_null ($request->input ('date_end')) ? $results : $results->Where ('Item_adjusteds.date', '<=', @$request->input ('date_end')))
				: (is_null ($request->input ('date_end')) ? $results->Where ('Item_adjusteds.date', '>=', @$request->input ('date_start')) : $results->whereBetween ('Item_adjusteds.date', [@$request->input ('date_start'), @$request->input ('date_end')])) : "" ;

				$results = $results->sortable()
				->paginate(config('core.paginate'));		
			}

		}else{
			$results = Item_adjusted::select($select)->sortable()->paginate(config('core.paginate'));
			//$results = Item_adjusted::all();
		}
		
		$compact = array();

		$compact['results'] = $results;
		$compact['arrShowField'] = $this->arrShowFieldIndex;
		
		$compact ['arradjusted_status'] = $this->arradjusted_status;
		$compact['request'] = $request->all();

		return view('item_adjusteds.index',  $compact);
	}

	public function create(Request $request)
	{
		$compact = array();
		$compact['arradjusted_status'] = $this->arradjusted_status;

		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		return view('item_adjusteds.add', $compact);	    
	}

	public function edit($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldFrom);

		$compact = array();
		
		$item_adjusted = Item_adjusted::select($select)->findOrFail($id);
		
		$compact['item_adjusted'] = $item_adjusted;
		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		$compact['arradjusted_status'] = $this->arradjusted_status;

		return view('item_adjusteds.add', $compact);
	}

	public function show($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldView);

		$item_adjusted = Item_adjusted::select($select)->findOrFail($id);

		$compact['results'] = $item_adjusted;
		$compact['arrShowFieldView'] = $this->arrShowFieldView;

		$compact['arradjusted_status'] = $this->arradjusted_status;

        return view('item_adjusteds.show', $compact);
	}

	public function update(Request $request, $id) {
		
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['updated_uid'] = Auth::id();

        $item_adjusted = Item_adjusted::findOrFail($id);
		$results = $item_adjusted->update($input);

		if ($results) {
			$message = __('core.update_success');
			$status = 'success';
			$title = __('core.update_title');
			DB::commit();
		} else {
			$message = __('core.update_success');
			$status = 'error';
			$title = __('core.update_title');
			DB::rollBack();
		}

		Session::flash('message', $message);
		Session::flash('status', $status);
		Session::flash('title', $title);
        
        return redirect('/item_adjusteds');
	}

	public function store(Request $request)
	{
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['created_uid'] = Auth::id();

        $item_adjusted = Item_adjusted::create($input);

		$lastInsertedId = $item_adjusted->id;

		if ($item_adjusted) {
			$message = __('core.add_success');
			$status = 'success';
			$title = __('core.add_title');
			DB::commit();
		} else {
			$message = __('core.add_error');
			$status = 'error';
			$title = __('core.add_title');
			DB::rollBack();
		}

		Session::flash('message', $message);
		Session::flash('status', $status);
		Session::flash('title', $title);

		return redirect('/item_adjusteds/'.$lastInsertedId.'/edit');
        //return redirect('/item_adjusteds');
		//return $this->update($request);
	}

	public function destroy($id) {

		DB::beginTransaction();

		$isUse = $this->chkUse($id);

		if (!$isUse) {

			$item_adjusted = Item_adjusted::findOrFail($id);
			$results = $item_adjusted->delete();

			if ($results) {
				$message = __('core.del_success');
				$status = 'success';
				DB::commit();
			} else {
				$message = __('core.del_error');
				$status = 'error';
				DB::rollBack();
			}

		} else {

			$message = __('core.del_is_use');
			$status = 'warning';
			$del_status = 'false';
			DB::rollBack();

		}

		$data['type'] = $status;
		$data['title'] = __('core.del_title');
		$data['message'] = $message;
		$data['del_status'] = $del_status;

		return $data;
	    
	}

	private function chkUse($id)
	{
		$results = "";
		//$results = Models\[otherModel]::select('id')->where('users_id', $id)->get()->count();

		return $results;
	}
}



/** 
 * CRUD Laravel
 * Master ฺBY Kepex  =>  https://github.com/kEpEx/laravel-crud-generator
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 13/04/2018 23:26
 * Version : ver.1.00.00
 *
 * File Create : 2018-07-25 00:17:45 *
 */