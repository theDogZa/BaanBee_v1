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
use App\Models\Auth_menu;
use Session;
use Cache;

use DB;

class Auth_menusesController extends Controller
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
		 'groups' => 1,  'parent_id' => 1,  'menu_name' => 1,  'menu_link' => 1,  'menu_icon' => 1,  'menu_sort' => 1,  'active' => 1, 	
		];
		$this->arrShowFieldFrom = [
		 'groups' => 1,  'parent_id' => 1,  'menu_name' => 1,  'menu_link' => 1,  'menu_icon' => 1,  'menu_sort' => 1,  'active' => 1, 
		];
		$this->arrShowFieldView = [
		 'groups' => 1,  'parent_id' => 1,  'menu_name' => 1,  'menu_link' => 1,  'menu_icon' => 1,  'menu_sort' => 1,  'active' => 1, 	
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
			'menu_name' => 'required|string|max:255',
			'menu_link' => 'required|string|max:255',
			'active' => 'required|string|max:255',
			//#Ex
			//'username' => 'required|string|max:20|unique:users,username,' . $data ['id'],
			//'email' => 'required|string|email|max:255|unique:users,email,' . $data ['id'],
			// 'password' => 'required|string|min:6|confirmed',
			//'password' => 'required|string|min:6',
		];
		
		$messages = [
			'menu_name.required' => trans('Auth_menu.menu_name_required'),
			'menu_link.required' => trans('Auth_menu.menu_link_required'),
			'active.required' => trans('Auth_menu.active_required'),
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
				$results = Auth_menu::select($select);
				//->join('tableA', 'auth_menuses.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'auth_menuses.tableB_id', '=', 'tableB.id')
				
				(!empty($this->arrShowFieldIndex['groups'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Auth_menus.groups', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['parent_id'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Auth_menus.parent_id', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['menu_name'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Auth_menus.menu_name', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['menu_link'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Auth_menus.menu_link', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['menu_icon'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Auth_menus.menu_icon', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['menu_sort'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Auth_menus.menu_sort', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['active'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Auth_menus.active', 'LIKE','%'. @$search.'%') : "" ;
				//$results = is_null ($search) ? $results : $results->orWhere ('tableA.columnName', 'LIKE','%'. @$search.'%') ;
				$results = $results->sortable()
				->paginate(config('core.paginate'));

			}else{

				$results = Auth_menu::select($select);
				//->join('tableA', 'auth_menuses.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'auth_menuses.tableB_id', '=', 'tableB.id')
				//->select('auth_menuses.*', 'tableA.columnName', 'tableB.columnName');
 
				(!empty($this->arrShowFieldIndex ['groups'])) ? $results = is_null ($request->input ('groups_start')) ? (is_null ($request->input ('groups_end')) ? $results : $results->Where ('Auth_menus.groups', '<=', @$request->input ('groups_end')))
				: (is_null ($request->input ('groups_end')) ? $results->Where ('Auth_menus.groups', '>=', @$request->input ('groups_start')) : $results->whereBetween ('Auth_menus.groups', [@$request->input ('groups_start'), @$request->input ('groups_end')])) : "" ;
				(!empty( $this->arrShowFieldIndex['parent_id'] ))? $results = is_null ($request->input ('parent_id')) ? $results : $results->Where ('Auth_menus.parent_id', '=', @$request->input ('parent_id')) : "" ;
				(!empty( $this->arrShowFieldIndex['menu_name'] ))? $results = is_null ($request->input ('menu_name')) ? $results : $results->Where ('Auth_menus.menu_name', 'LIKE', @$request->input ('menu_name')) : "" ;
				(!empty( $this->arrShowFieldIndex['menu_link'] ))? $results = is_null ($request->input ('menu_link')) ? $results : $results->Where ('Auth_menus.menu_link', 'LIKE', @$request->input ('menu_link')) : "" ;
				(!empty( $this->arrShowFieldIndex['menu_icon'] ))? $results = is_null ($request->input ('menu_icon')) ? $results : $results->Where ('Auth_menus.menu_icon', 'LIKE', @$request->input ('menu_icon')) : "" ;
 
				(!empty($this->arrShowFieldIndex ['menu_sort'])) ? $results = is_null ($request->input ('menu_sort_start')) ? (is_null ($request->input ('menu_sort_end')) ? $results : $results->Where ('Auth_menus.menu_sort', '<=', @$request->input ('menu_sort_end')))
				: (is_null ($request->input ('menu_sort_end')) ? $results->Where ('Auth_menus.menu_sort', '>=', @$request->input ('menu_sort_start')) : $results->whereBetween ('Auth_menus.menu_sort', [@$request->input ('menu_sort_start'), @$request->input ('menu_sort_end')])) : "" ;
				(!empty( $this->arrShowFieldIndex['active'] ))? $results = is_null ($request->input ('active')) ? $results : $results->Where('Auth_menus.active', '=', @$request->input ('active')) : "" ;

				$results = $results->sortable()
				->paginate(config('core.paginate'));		
			}

		}else{
			$results = Auth_menu::select($select)->sortable()->paginate(config('core.paginate'));
			//$results = Auth_menu::all();
		}
		
		$compact = array();

		$compact['results'] = $results;
		$compact['arrShowField'] = $this->arrShowFieldIndex;
		
		$Auth_menus = ['' => '']+App\Models\Auth_menu::where('id','!=',null)
			->orderBy('id')
			->pluck('id','id')	
			->toArray();
			
		$compact['Auth_menu'] = $Auth_menus; 

		$compact['request'] = $request->all();

		return view('auth_menuses.index',  $compact);
	}

	public function create(Request $request)
	{
		$compact = array();
		$Auth_menus = ['' => '']+App\Models\Auth_menu::where('id','!=',null)
			->orderBy('id')
			->pluck('id','id')	
			->toArray();			
		$compact['Auth_menu'] = $Auth_menus;


		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		return view('auth_menuses.add', $compact);	    
	}

	public function edit($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldFrom);

		$compact = array();
		
		$auth_menu = Auth_menu::select($select)->findOrFail($id);
		
		$compact['auth_menu'] = $auth_menu;
		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		$Auth_menus = ['' => '']+App\Models\Auth_menu::where('id','!=',null)
			->orderBy('id')
			->pluck('id','id')	
			->toArray();			
		$compact['Auth_menu'] = $Auth_menus; 


		return view('auth_menuses.add', $compact);
	}

	public function show($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldView);

		$auth_menu = Auth_menu::select($select)->findOrFail($id);

		$compact['results'] = $auth_menu;
		$compact['arrShowFieldView'] = $this->arrShowFieldView;

		$Auth_menus = App\Models\Auth_menu::where ('id', '!=', null)
			->orderBy ('id')
			->pluck ('id', 'id')
			->toArray ();		
		$compact['Auth_menu'] = $Auth_menus;
		

        return view('auth_menuses.show', $compact);
	}

	public function update(Request $request, $id) {
		
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['updated_uid'] = Auth::id();

        $auth_menu = Auth_menu::findOrFail($id);
		$results = $auth_menu->update($input);

		if ($results) {
			$message = __('core.update_success');
			$status = 'success';
			DB::commit();
		} else {
			$message = __('core.update_success');
			$status = 'error';
			DB::rollBack();
		}

		Session::flash('message', $message);
		Session::flash('status', $status);
        

        return redirect('/auth_menuses');
	}

	public function store(Request $request)
	{
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['created_uid'] = Auth::id();

        $auth_menu = Auth_menu::create($input);

		$lastInsertedId = $auth_menu->id;

		if ($auth_menu) {
			$message = __('core.add_success');
			$status = 'success';
			DB::commit();
		} else {
			$message = __('core.add_error');
			$status = 'error';
			DB::rollBack();
		}

		Session::flash('message', $message);
		Session::flash('status', $status);

		return redirect('/auth_menuses/'.$lastInsertedId.'/edit');
        //return redirect('/auth_menuses');
		//return $this->update($request);
	}

	public function destroy($id) {

		DB::beginTransaction();

		$isUse = $this->chkUse($id);

		if (!$isUse) {

			$auth_menu = Auth_menu::findOrFail($id);
			$results = $auth_menu->delete();

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
 * File Create : 2018-04-17 22:48:07 *
 */