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
use App\Models\Item_color;
use Session;
use Cache;

use DB;

class Item_colorsController extends Controller
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
		 'color_name' => 1,  'color_code' => 1,  'color_desc' => 1,  'active' => 1, 	
		];
		$this->arrShowFieldFrom = [
		 'color_name' => 1,  'color_code' => 1,  'color_desc' => 1,  'active' => 1, 
		];
		$this->arrShowFieldView = [
		 'color_name' => 1,  'color_code' => 1,  'color_desc' => 1,  'active' => 1, 	
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
			'color_name' => 'required|string|max:255',
			'color_code' => 'required|string|max:255',
			//#Ex
			//'username' => 'required|string|max:20|unique:users,username,' . $data ['id'],
			//'email' => 'required|string|email|max:255|unique:users,email,' . $data ['id'],
			// 'password' => 'required|string|min:6|confirmed',
			//'password' => 'required|string|min:6',
		];
		
		$messages = [
			'color_name.required' => trans('Item_color.color_name_required'),
			'color_code.required' => trans('Item_color.color_code_required'),
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
				$results = Item_color::select($select);
				//->join('tableA', 'item_colors.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'item_colors.tableB_id', '=', 'tableB.id')
				
				(!empty($this->arrShowFieldIndex['color_name'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_colors.color_name', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['color_code'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_colors.color_code', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['color_desc'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_colors.color_desc', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['active'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Item_colors.active', 'LIKE','%'. @$search.'%') : "" ;
				//$results = is_null ($search) ? $results : $results->orWhere ('tableA.columnName', 'LIKE','%'. @$search.'%') ;
				$results = $results->sortable()
				->paginate(config('core.paginate'));

			}else{

				$results = Item_color::select($select);
				//->join('tableA', 'item_colors.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'item_colors.tableB_id', '=', 'tableB.id')
				//->select('item_colors.*', 'tableA.columnName', 'tableB.columnName');
				(!empty( $this->arrShowFieldIndex['color_name'] ))? $results = is_null ($request->input ('color_name')) ? $results : $results->Where ('Item_colors.color_name', 'LIKE', @$request->input ('color_name')) : "" ;
				(!empty( $this->arrShowFieldIndex['color_code'] ))? $results = is_null ($request->input ('color_code')) ? $results : $results->Where ('Item_colors.color_code', 'LIKE', @$request->input ('color_code')) : "" ;
				(!empty( $this->arrShowFieldIndex['color_desc'] ))? $results = is_null ($request->input ('color_desc')) ? $results : $results->Where ('Item_colors.color_desc', 'LIKE', @$request->input ('color_desc')) : "" ;
				(!empty( $this->arrShowFieldIndex['active'] ))? $results = is_null ($request->input ('active')) ? $results : $results->Where('Item_colors.active', '=', @$request->input ('active')) : "" ;

				$results = $results->sortable()
				->paginate(config('core.paginate'));		
			}

		}else{
			$results = Item_color::select($select)->sortable()->paginate(config('core.paginate'));
			//$results = Item_color::all();
		}
		
		$compact = array();

		$compact['results'] = $results;
		$compact['arrShowField'] = $this->arrShowFieldIndex;
		
		$compact['request'] = $request->all();

		return view('item_colors.index',  $compact);
	}

	public function create(Request $request)
	{
		$compact = array();

		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		return view('item_colors.add', $compact);	    
	}

	public function edit($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldFrom);

		$compact = array();
		
		$item_color = Item_color::select($select)->findOrFail($id);
		
		$compact['item_color'] = $item_color;
		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;


		return view('item_colors.add', $compact);
	}

	public function show($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldView);

		$item_color = Item_color::select($select)->findOrFail($id);

		$compact['results'] = $item_color;
		$compact['arrShowFieldView'] = $this->arrShowFieldView;


        return view('item_colors.show', $compact);
	}

	public function update(Request $request, $id) {
		
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['updated_uid'] = Auth::id();

        $item_color = Item_color::findOrFail($id);
		$results = $item_color->update($input);

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
        
        return redirect('/item_colors');
	}

	public function store(Request $request)
	{
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['created_uid'] = Auth::id();

        $item_color = Item_color::create($input);

		$lastInsertedId = $item_color->id;

		if ($item_color) {
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

		return redirect('/item_colors/'.$lastInsertedId.'/edit');
        //return redirect('/item_colors');
		//return $this->update($request);
	}

	public function destroy($id) {

		DB::beginTransaction();

		$isUse = $this->chkUse($id);

		if (!$isUse) {

			$item_color = Item_color::findOrFail($id);
			$results = $item_color->delete();

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
		$colorCode = $request->input('color_code');
		$results = Item_color::select('id')->where('color_code', $colorCode)->get();

		if (!$results->isEmpty()) {
			if ($id != null) {
				if ($id == $results[0]->id) {
					return true;
				} else {
					return 'false';
				}
			} else {
				return 'false';
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
 * File Create : 2018-04-28 18:18:57 *
 */