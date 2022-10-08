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
use App\Models\Item_unit;
use Session;
use Cache;

use DB;

class Item_unitsController extends Controller
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
		 'unit_name' => 1,  'unit_desc' => 1,  'active' => 1, 	
		];
		$this->arrShowFieldFrom = [
		 'unit_name' => 1,  'unit_desc' => 1,  'active' => 1, 
		];
		$this->arrShowFieldView = [
		 'unit_name' => 1,  'unit_desc' => 1,  'active' => 1, 	
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
			'unit_name' => 'required|string|max:255',
			//#Ex
			//'username' => 'required|string|max:20|unique:users,username,' . $data ['id'],
			//'email' => 'required|string|email|max:255|unique:users,email,' . $data ['id'],
			// 'password' => 'required|string|min:6|confirmed',
			//'password' => 'required|string|min:6',
		];
		
		$messages = [
			'unit_name.required' => trans('Item_unit.unit_name_required'),
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
				$results = Item_unit::select($select);
				//->join('tableA', 'item_units.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'item_units.tableB_id', '=', 'tableB.id')
				
				(!empty($this->arrShowFieldIndex['unit_name'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_units.unit_name', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['unit_desc'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_units.unit_desc', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['active'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_units.active', 'LIKE','%'. @$search.'%') : "" ;
				//$results = is_null ($search) ? $results : $results->orWhere ('tableA.columnName', 'LIKE','%'. @$search.'%') ;
				$results = $results->sortable()
				->paginate(config('core.paginate'));

			}else{

				$results = Item_unit::select($select);
				//->join('tableA', 'item_units.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'item_units.tableB_id', '=', 'tableB.id')
				//->select('item_units.*', 'tableA.columnName', 'tableB.columnName');
				(!empty( $this->arrShowFieldIndex['unit_name'] ))? $results = is_null ($request->input ('unit_name')) ? $results : $results->Where ('Item_units.unit_name', 'LIKE', @$request->input ('unit_name')) : "" ;
				(!empty( $this->arrShowFieldIndex['unit_desc'] ))? $results = is_null ($request->input ('unit_desc')) ? $results : $results->Where ('Item_units.unit_desc', 'LIKE', @$request->input ('unit_desc')) : "" ;
				(!empty( $this->arrShowFieldIndex['active'] ))? $results = is_null ($request->input ('active')) ? $results : $results->Where('Item_units.active', '=', @$request->input ('active')) : "" ;

				$results = $results->sortable()
				->paginate(config('core.paginate'));		
			}

		}else{
			$results = Item_unit::select($select)->sortable()->paginate(config('core.paginate'));
			//$results = Item_unit::all();
		}
		
		$compact = array();

		$compact['results'] = $results;
		$compact['arrShowField'] = $this->arrShowFieldIndex;
		
		$compact['request'] = $request->all();

		return view('item_units.index',  $compact);
	}

	public function create(Request $request)
	{
		$compact = array();

		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		return view('item_units.add', $compact);	    
	}

	public function edit($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldFrom);

		$compact = array();
		
		$item_unit = Item_unit::select($select)->findOrFail($id);
		
		$compact['item_unit'] = $item_unit;
		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;


		return view('item_units.add', $compact);
	}

	public function show($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldView);

		$item_unit = Item_unit::select($select)->findOrFail($id);

		$compact['results'] = $item_unit;
		$compact['arrShowFieldView'] = $this->arrShowFieldView;


        return view('item_units.show', $compact);
	}

	public function update(Request $request, $id) {
		
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['updated_uid'] = Auth::id();

        $item_unit = Item_unit::findOrFail($id);
		$results = $item_unit->update($input);

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
        
        return redirect('/item_units');
	}

	public function store(Request $request)
	{
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['created_uid'] = Auth::id();

        $item_unit = Item_unit::create($input);

		$lastInsertedId = $item_unit->id;

		if ($item_unit) {
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

		return redirect('/item_units/'.$lastInsertedId.'/edit');
        //return redirect('/item_units');
		//return $this->update($request);
	}

	public function destroy($id) {

		DB::beginTransaction();

		$isUse = $this->chkUse($id);

		if (!$isUse) {

			$item_unit = Item_unit::findOrFail($id);
			$results = $item_unit->delete();

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
 * File Create : 2018-04-28 18:18:43 *
 */