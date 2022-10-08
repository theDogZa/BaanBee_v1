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
use App\Models\User;
use Session;
use Cache;

use DB;

class UsersController extends Controller
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
		 'name' => 1,  'username' => 1,  'email' => 1,  'password' => 0,  'remember_token' => 0,  'online' => 0,  'active' => 1, 	
		];
		$this->arrShowFieldFrom = [
		 'name' => 1,  'username' => 1,  'email' => 1,  'password' => 1,  'remember_token' => 0,  'online' => 0,  'active' => 1, 
		];
		$this->arrShowFieldView = [
		 'name' => 1,  'username' => 1,  'email' => 1,  'password' => 1,  'remember_token' => 0,  'online' => 0,  'active' => 1, 	
		];

																								
		//arr val for online to Radio, CheckBox and Select
		$this->arronline = ['1','2'];
								
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
			'name' => 'required|string|max:255',
			'username' => 'required|string|max:255',
			'email' => 'required|string|max:255',
			'password' => 'required|string|max:255',
			'active' => 'required|string|max:255',
			//#Ex
			//'username' => 'required|string|max:20|unique:users,username,' . $data ['id'],
			//'email' => 'required|string|email|max:255|unique:users,email,' . $data ['id'],
			// 'password' => 'required|string|min:6|confirmed',
			//'password' => 'required|string|min:6',
		];
		
		$messages = [
			'name.required' => trans('User.name_required'),
			'username.required' => trans('User.username_required'),
			'email.required' => trans('User.email_required'),
			'password.required' => trans('User.password_required'),
			'active.required' => trans('User.active_required'),
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
				$results = User::select($select);
				//->join('tableA', 'users.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'users.tableB_id', '=', 'tableB.id')
				
				(!empty($this->arrShowFieldIndex['name'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Users.name', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['username'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Users.username', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['email'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Users.email', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['password'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Users.password', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['remember_token'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Users.remember_token', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['online'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Users.online', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['active'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Users.active', 'LIKE','%'. @$search.'%') : "" ;
				//$results = is_null ($search) ? $results : $results->orWhere ('tableA.columnName', 'LIKE','%'. @$search.'%') ;
				$results = $results->sortable()
				->paginate(config('core.paginate'));

			}else{

				$results = User::select($select);
				//->join('tableA', 'users.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'users.tableB_id', '=', 'tableB.id')
				//->select('users.*', 'tableA.columnName', 'tableB.columnName');
				(!empty( $this->arrShowFieldIndex['name'] ))? $results = is_null ($request->input ('name')) ? $results : $results->Where ('Users.name', 'LIKE', @$request->input ('name')) : "" ;
				(!empty( $this->arrShowFieldIndex['username'] ))? $results = is_null ($request->input ('username')) ? $results : $results->Where ('Users.username', 'LIKE', @$request->input ('username')) : "" ;
				(!empty( $this->arrShowFieldIndex['email'] ))? $results = is_null ($request->input ('email')) ? $results : $results->Where ('Users.email', 'LIKE', @$request->input ('email')) : "" ;
				(!empty( $this->arrShowFieldIndex['password'] ))? $results = is_null ($request->input ('password')) ? $results : $results->Where ('Users.password', 'LIKE', @$request->input ('password')) : "" ;
				(!empty( $this->arrShowFieldIndex['remember_token'] ))? $results = is_null ($request->input ('remember_token')) ? $results : $results->Where ('Users.remember_token', 'LIKE', @$request->input ('remember_token')) : "" ;
				(!empty( $this->arrShowFieldIndex['online'] ))? $results = is_null ($request->input ('online')) ? $results : $results->Where('Users.online', '=', @$request->input ('online')) : "" ;
				(!empty( $this->arrShowFieldIndex['active'] ))? $results = is_null ($request->input ('active')) ? $results : $results->Where('Users.active', '=', @$request->input ('active')) : "" ;

				$results = $results->sortable()
				->paginate(config('core.paginate'));		
			}

		}else{
			$results = User::select($select)->sortable()->paginate(config('core.paginate'));
			//$results = User::all();
		}
		
		$compact = array();

		$compact['results'] = $results;
		$compact['arrShowField'] = $this->arrShowFieldIndex;
		
		$compact ['arronline'] = $this->arronline;
		$compact['request'] = $request->all();

		return view('users.index',  $compact);
	}

	public function create(Request $request)
	{
		$compact = array();
		$compact['arronline'] = $this->arronline;

		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		return view('users.add', $compact);	    
	}

	public function edit($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldFrom);

		$compact = array();
		
		$user = User::select($select)->findOrFail($id);
		
		$compact['user'] = $user;
		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		$compact['arronline'] = $this->arronline;

		return view('users.add', $compact);
	}

	public function show($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldView);

		$user = User::select($select)->findOrFail($id);

		$compact['results'] = $user;
		$compact['arrShowFieldView'] = $this->arrShowFieldView;

		$compact['arronline'] = $this->arronline;

        return view('users.show', $compact);
	}

	public function update(Request $request, $id) {
		
		//$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['password'] = bcrypt($request->input('new_password'));
		$input['updated_uid'] = Auth::id();

        $user = User::findOrFail($id);
		$results = $user->update($input);

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
        

        return redirect('/users');
	}

	public function store(Request $request)
	{
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();

		$input['password'] = bcrypt($request->input('new_password'));
		$input['created_uid'] = Auth::id();

        $user = User::create($input);

		$lastInsertedId = $user->id;

		if ($user) {
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

		return redirect('/users/'.$lastInsertedId.'/edit');
        //return redirect('/users');
		//return $this->update($request);
	}

	public function destroy($id) {

		DB::beginTransaction();

		$isUse = $this->chkUse($id);

		if (!$isUse) {

			$user = User::findOrFail($id);
			$results = $user->delete();

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

	public function checkUsername(Request $request, $id)
	{
		$username = $request->input('username');
		$results = User::select('id')->where('username', $username)->get();
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

	public function checkEmail(Request $request, $id)
	{
		$email = $request->input('email');
		$results = User::select('id')->where('email', $email)->get();
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
 * Latest Update : 15/04/2018 03:11
 * Version : ver.1.00.00
 *
 * File Create : 2018-04-15 00:04:43 *
 */