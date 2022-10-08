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
use App\Models\Item_adjusted_type;
use Session;
use Cache;

use DB;

class Item_adjusted_typesController extends Controller
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
		 'adjusted_type_codes' => 1,  'adjusted_type_name_th' => 1,  'adjusted_type_name_en' => 1,  'adjusted_type_desc' => 1,  'active' => 1, 	
		];
		$this->arrShowFieldFrom = [
		 'adjusted_type_codes' => 1,  'adjusted_type_name_th' => 1,  'adjusted_type_name_en' => 1,  'adjusted_type_desc' => 1,  'active' => 1, 
		];
		$this->arrShowFieldView = [
		 'adjusted_type_codes' => 1,  'adjusted_type_name_th' => 1,  'adjusted_type_name_en' => 1,  'adjusted_type_desc' => 1,  'active' => 1, 	
		];

																						
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
			'adjusted_type_codes' => 'required|string|max:255',
			//#Ex
			//'username' => 'required|string|max:20|unique:users,username,' . $data ['id'],
			//'email' => 'required|string|email|max:255|unique:users,email,' . $data ['id'],
			// 'password' => 'required|string|min:6|confirmed',
			//'password' => 'required|string|min:6',
		];
		
		$messages = [
			'adjusted_type_codes.required' => trans('Item_adjusted_type.adjusted_type_codes_required'),
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
				$results = Item_adjusted_type::select($select);
				//->join('tableA', 'item_adjusted_types.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'item_adjusted_types.tableB_id', '=', 'tableB.id')
				
				(!empty($this->arrShowFieldIndex['adjusted_type_codes'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_adjusted_types.adjusted_type_codes', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['adjusted_type_name_th'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_adjusted_types.adjusted_type_name_th', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['adjusted_type_name_en'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_adjusted_types.adjusted_type_name_en', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['adjusted_type_desc'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_adjusted_types.adjusted_type_desc', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['active'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_adjusted_types.active', 'LIKE','%'. @$search.'%') : "" ;
				//$results = is_null ($search) ? $results : $results->orWhere ('tableA.columnName', 'LIKE','%'. @$search.'%') ;
				$results = $results->sortable()
				->paginate(config('core.paginate'));

			}else{

				$results = Item_adjusted_type::select($select);
				//->join('tableA', 'item_adjusted_types.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'item_adjusted_types.tableB_id', '=', 'tableB.id')
				//->select('item_adjusted_types.*', 'tableA.columnName', 'tableB.columnName');
				(!empty( $this->arrShowFieldIndex['adjusted_type_codes'] ))? $results = is_null ($request->input ('adjusted_type_codes')) ? $results : $results->Where ('Item_adjusted_types.adjusted_type_codes', 'LIKE', @$request->input ('adjusted_type_codes')) : "" ;
				(!empty( $this->arrShowFieldIndex['adjusted_type_name_th'] ))? $results = is_null ($request->input ('adjusted_type_name_th')) ? $results : $results->Where ('Item_adjusted_types.adjusted_type_name_th', 'LIKE', @$request->input ('adjusted_type_name_th')) : "" ;
				(!empty( $this->arrShowFieldIndex['adjusted_type_name_en'] ))? $results = is_null ($request->input ('adjusted_type_name_en')) ? $results : $results->Where ('Item_adjusted_types.adjusted_type_name_en', 'LIKE', @$request->input ('adjusted_type_name_en')) : "" ;
				(!empty( $this->arrShowFieldIndex['adjusted_type_desc'] ))? $results = is_null ($request->input ('adjusted_type_desc')) ? $results : $results->Where ('Item_adjusted_types.adjusted_type_desc', 'LIKE', @$request->input ('adjusted_type_desc')) : "" ;
				(!empty( $this->arrShowFieldIndex['active'] ))? $results = is_null ($request->input ('active')) ? $results : $results->Where('Item_adjusted_types.active', '=', @$request->input ('active')) : "" ;

				$results = $results->sortable()
				->paginate(config('core.paginate'));		
			}

		}else{
			$results = Item_adjusted_type::select($select)->sortable()->paginate(config('core.paginate'));
			//$results = Item_adjusted_type::all();
		}
		
		$compact = array();

		$compact['results'] = $results;
		$compact['arrShowField'] = $this->arrShowFieldIndex;
		
		$compact['request'] = $request->all();

		return view('item_adjusted_types.index',  $compact);
	}

	public function create(Request $request)
	{
		$compact = array();

		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		return view('item_adjusted_types.add', $compact);	    
	}

	public function edit($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldFrom);

		$compact = array();
		
		$item_adjusted_type = Item_adjusted_type::select($select)->findOrFail($id);
		
		$compact['item_adjusted_type'] = $item_adjusted_type;
		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;


		return view('item_adjusted_types.add', $compact);
	}

	public function show($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldView);

		$item_adjusted_type = Item_adjusted_type::select($select)->findOrFail($id);

		$compact['results'] = $item_adjusted_type;
		$compact['arrShowFieldView'] = $this->arrShowFieldView;


        return view('item_adjusted_types.show', $compact);
	}

	public function update(Request $request, $id) {
		
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['updated_uid'] = Auth::id();

        $item_adjusted_type = Item_adjusted_type::findOrFail($id);
		$results = $item_adjusted_type->update($input);

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
        
        return redirect('/item_adjusted_types');
	}

	public function store(Request $request)
	{
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['created_uid'] = Auth::id();

        $item_adjusted_type = Item_adjusted_type::create($input);

		$lastInsertedId = $item_adjusted_type->id;

		if ($item_adjusted_type) {
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

		return redirect('/item_adjusted_types/'.$lastInsertedId.'/edit');
        //return redirect('/item_adjusted_types');
		//return $this->update($request);
	}

	public function destroy($id) {

		DB::beginTransaction();

		$isUse = $this->chkUse($id);

		if (!$isUse) {

			$item_adjusted_type = Item_adjusted_type::findOrFail($id);
			$results = $item_adjusted_type->delete();

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
 * File Create : 2018-07-24 01:07:15 *
 */