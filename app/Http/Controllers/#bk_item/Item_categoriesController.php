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
use App\Models\Item_category;
use Session;
use Cache;

use DB;

class Item_categoriesController extends Controller
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
		 'item_type_id' => 1,  'categories_name' => 1,  'categories_code' => 1,  'categories_desc' => 1,  'active' => 1, 	
		];
		$this->arrShowFieldFrom = [
		 'item_type_id' => 1,  'categories_name' => 1,  'categories_code' => 1,  'categories_desc' => 1,  'active' => 1, 
		];
		$this->arrShowFieldView = [
		 'item_type_id' => 1,  'categories_name' => 1,  'categories_code' => 1,  'categories_desc' => 1,  'active' => 1, 	
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
			'item_type_id' => 'required|string|max:255',
			'categories_name' => 'required|string|max:255',
			'categories_code' => 'required|string|max:255',
			//#Ex
			//'username' => 'required|string|max:20|unique:users,username,' . $data ['id'],
			//'email' => 'required|string|email|max:255|unique:users,email,' . $data ['id'],
			// 'password' => 'required|string|min:6|confirmed',
			//'password' => 'required|string|min:6',
		];
		
		$messages = [
			'item_type_id.required' => trans('Item_category.item_type_id_required'),
			'categories_name.required' => trans('Item_category.categories_name_required'),
			'categories_code.required' => trans('Item_category.categories_code_required'),
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
				$results = Item_category::select($select);
				//->join('tableA', 'item_categories.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'item_categories.tableB_id', '=', 'tableB.id')
				
				(!empty($this->arrShowFieldIndex['item_type_id'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_categories.item_type_id', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['categories_name'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_categories.categories_name', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['categories_code'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_categories.categories_code', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['categories_desc'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_categories.categories_desc', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['active'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_categories.active', 'LIKE','%'. @$search.'%') : "" ;
				//$results = is_null ($search) ? $results : $results->orWhere ('tableA.columnName', 'LIKE','%'. @$search.'%') ;
				$results = $results->sortable()
				->paginate(config('core.paginate'));

			}else{

				$results = Item_category::select($select);
				//->join('tableA', 'item_categories.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'item_categories.tableB_id', '=', 'tableB.id')
				//->select('item_categories.*', 'tableA.columnName', 'tableB.columnName');
				(!empty( $this->arrShowFieldIndex['item_type_id'] ))? $results = is_null ($request->input ('item_type_id')) ? $results : $results->Where ('Item_categories.item_type_id', '=', @$request->input ('item_type_id')) : "" ;
				(!empty( $this->arrShowFieldIndex['categories_name'] ))? $results = is_null ($request->input ('categories_name')) ? $results : $results->Where ('Item_categories.categories_name', 'LIKE', @$request->input ('categories_name')) : "" ;
				(!empty( $this->arrShowFieldIndex['categories_code'] ))? $results = is_null ($request->input ('categories_code')) ? $results : $results->Where ('Item_categories.categories_code', 'LIKE', @$request->input ('categories_code')) : "" ;
				(!empty( $this->arrShowFieldIndex['categories_desc'] ))? $results = is_null ($request->input ('categories_desc')) ? $results : $results->Where ('Item_categories.categories_desc', 'LIKE', @$request->input ('categories_desc')) : "" ;
				(!empty( $this->arrShowFieldIndex['active'] ))? $results = is_null ($request->input ('active')) ? $results : $results->Where('Item_categories.active', '=', @$request->input ('active')) : "" ;

				$results = $results->sortable()
				->paginate(config('core.paginate'));		
			}

		}else{
			$results = Item_category::select($select)->sortable()->paginate(config('core.paginate'));
			//$results = Item_category::all();
		}
		
		$compact = array();

		$compact['results'] = $results;
		$compact['arrShowField'] = $this->arrShowFieldIndex;
		
		$Item_types = ['' => '']+App\Models\Item_type::where('id','!=',null)
			->select(DB::raw("CONCAT(type_code,' - ',type_name) AS name"),'id')
			->orderBy('id')
			->pluck('name','id')	
			->toArray();
			
		$compact['Item_type'] = $Item_types; 

		$compact['request'] = $request->all();

		return view('item_categories.index',  $compact);
	}

	public function create(Request $request)
	{
		$compact = array();
		$Item_types = ['' => '']+App\Models\Item_type::where('id','!=',null)
			->select(DB::raw("CONCAT(type_code,' - ',type_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name','id')	
			->toArray();			
		$compact['Item_type'] = $Item_types;


		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		return view('item_categories.add', $compact);	    
	}

	public function edit($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldFrom);

		$compact = array();
		
		$item_category = Item_category::select($select)->findOrFail($id);
		
		$compact['item_category'] = $item_category;
		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		$Item_types = ['' => '']+App\Models\Item_type::where('id','!=',null)
			->select(DB::raw("CONCAT(type_code,' - ',type_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name','id')	
			->toArray();			
		$compact['Item_type'] = $Item_types; 


		return view('item_categories.add', $compact);
	}

	public function show($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldView);

		$item_category = Item_category::select($select)->findOrFail($id);

		$compact['results'] = $item_category;
		$compact['arrShowFieldView'] = $this->arrShowFieldView;

		$Item_types = App\Models\Item_type::where ('id', '!=', null)
			->select(DB::raw("CONCAT(type_code,' ',type_name) AS name"), 'id')
			->orderBy ('id')
			->pluck ('name', 'id')
			->toArray ();		
		$compact['Item_type'] = $Item_types;
		

        return view('item_categories.show', $compact);
	}

	public function update(Request $request, $id) {
		
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['updated_uid'] = Auth::id();

        $item_category = Item_category::findOrFail($id);
		$results = $item_category->update($input);

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
        
        return redirect('/item_categories');
	}

	public function store(Request $request)
	{
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['created_uid'] = Auth::id();

        $item_category = Item_category::create($input);

		$lastInsertedId = $item_category->id;

		if ($item_category) {
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

		return redirect('/item_categories/'.$lastInsertedId.'/edit');
        //return redirect('/item_categories');
		//return $this->update($request);
	}

	public function destroy($id) {

		DB::beginTransaction();

		$isUse = $this->chkUse($id);

		if (!$isUse) {

			$item_category = Item_category::findOrFail($id);
			$results = $item_category->delete();

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

	public function checkCode(Request $request, $id = null)
	{
		$categoriesCode = $request->input('categories_code');
		$results = Item_category::select('id')->where('categories_code', $categoriesCode)->get();

		if (!$results->isEmpty()) {
			if ($id != null) {
				if ($id == $results[0]->id) {
					return true;
				} else {
					return 'false';
				}
			} else {
				return 'false2';
			}
		} else {
			return true;
		}
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
 * File Create : 2018-04-28 17:51:42 *
 */