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
use App\Models\Example;
use Session;
use Cache;

use DB;

class ExamplesController extends Controller
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
		 'parent_id' => 1,  'users_id' => 1,  'title' => 1,  'body' => 1,  'amount' => 1,  'date' => 1,  'time' => 1,  'datetime' => 1,  'status' => 1,  'active' => 1, 	
		];
		$this->arrShowFieldFrom = [
		 'parent_id' => 1,  'users_id' => 1,  'title' => 1,  'body' => 1,  'amount' => 1,  'date' => 1,  'time' => 1,  'datetime' => 1,  'status' => 1,  'active' => 1, 
		];
		$this->arrShowFieldView = [
		 'parent_id' => 1,  'users_id' => 1,  'title' => 1,  'body' => 1,  'amount' => 1,  'date' => 1,  'time' => 1,  'datetime' => 1,  'status' => 1,  'active' => 1, 	
		];

																																				
		//arr val for status to Radio, CheckBox and Select
		$this->arrstatus = ['1','2'];
								
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
			'users_id' => 'required|string|max:255',
			'title' => 'required|string|max:255',
			'body' => 'required|string|max:255',
			'amount' => 'required|string|max:255',
			'datetime' => 'required|string|max:255',
			'active' => 'required|string|max:255',
			//#Ex
			//'username' => 'required|string|max:20|unique:users,username,' . $data ['id'],
			//'email' => 'required|string|email|max:255|unique:users,email,' . $data ['id'],
			// 'password' => 'required|string|min:6|confirmed',
			//'password' => 'required|string|min:6',
		];
		
		$messages = [
			'users_id.required' => trans('Example.users_id_required'),
			'title.required' => trans('Example.title_required'),
			'body.required' => trans('Example.body_required'),
			'amount.required' => trans('Example.amount_required'),
			'datetime.required' => trans('Example.datetime_required'),
			'active.required' => trans('Example.active_required'),
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
				$results = Example::select($select);
				//->join('tableA', 'examples.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'examples.tableB_id', '=', 'tableB.id')
				
				(!empty($this->arrShowFieldIndex['parent_id'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Examples.parent_id', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['users_id'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Examples.users_id', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['title'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Examples.title', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['body'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Examples.body', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['amount'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Examples.amount', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['date'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Examples.date', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['time'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Examples.time', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['datetime'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Examples.datetime', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['status'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Examples.status', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['active'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Examples.active', 'LIKE','%'. @$search.'%') : "" ;
				//$results = is_null ($search) ? $results : $results->orWhere ('tableA.columnName', 'LIKE','%'. @$search.'%') ;
				$results = $results->sortable()
				->paginate(config('core.paginate'));

			}else{

				$results = Example::select($select);
				//->join('tableA', 'examples.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'examples.tableB_id', '=', 'tableB.id')
				//->select('examples.*', 'tableA.columnName', 'tableB.columnName');
				(!empty( $this->arrShowFieldIndex['parent_id'] ))? $results = is_null ($request->input ('parent_id')) ? $results : $results->Where ('Examples.parent_id', '=', @$request->input ('parent_id')) : "" ;
				(!empty( $this->arrShowFieldIndex['users_id'] ))? $results = is_null ($request->input ('users_id')) ? $results : $results->Where ('Examples.users_id', '=', @$request->input ('users_id')) : "" ;
				(!empty( $this->arrShowFieldIndex['title'] ))? $results = is_null ($request->input ('title')) ? $results : $results->Where ('Examples.title', 'LIKE', @$request->input ('title')) : "" ;
				(!empty( $this->arrShowFieldIndex['body'] ))? $results = is_null ($request->input ('body')) ? $results : $results->Where ('Examples.body', 'LIKE', @$request->input ('body')) : "" ;
 
				(!empty($this->arrShowFieldIndex ['amount'])) ? $results = is_null ($request->input ('amount_start')) ? (is_null ($request->input ('amount_end')) ? $results : $results->Where ('Examples.amount', '<=', @$request->input ('amount_end')))
				: (is_null ($request->input ('amount_end')) ? $results->Where ('Examples.amount', '>=', @$request->input ('amount_start')) : $results->whereBetween ('Examples.amount', [@$request->input ('amount_start'), @$request->input ('amount_end')])) : "" ;
				(!empty( $this->arrShowFieldIndex['status'] ))? $results = is_null ($request->input ('status')) ? $results : $results->Where('Examples.status', '=', @$request->input ('status')) : "" ;
				(!empty( $this->arrShowFieldIndex['active'] ))? $results = is_null ($request->input ('active')) ? $results : $results->Where('Examples.active', '=', @$request->input ('active')) : "" ;
				(!empty( $this->arrShowFieldIndex['date'] ))? $results = is_null ($request->input ('date_start')) ? (is_null ($request->input ('date_end')) ? $results : $results->Where ('Examples.date', '<=', @$request->input ('date_end')))
				: (is_null ($request->input ('date_end')) ? $results->Where ('Examples.date', '>=', @$request->input ('date_start')) : $results->whereBetween ('Examples.date', [@$request->input ('date_start'), @$request->input ('date_end')])) : "" ;
				(!empty( $this->arrShowFieldIndex['time'] ))? $results = is_null ($request->input ('time_start')) ? (is_null ($request->input ('time_end')) ? $results : $results->Where ('Examples.time', '<=', @$request->input ('time_end') . ":00"))
				: (is_null ($request->input ('time_end')) ? $results->Where ('Examples.time', '>=', @$request->input ('time_start') . ":00") : $results->whereBetween ('Examples.time', [@$request->input ('time_start') . ":00", @$request->input ('time_end') . ":00"])) : "" ;
				(!empty( $this->arrShowFieldIndex['datetime'] ))? $results = is_null ($request->input ('datetime_start')) ? (is_null ($request->input ('datetime_end')) ? $results : $results->Where ('Examples.datetime', '<=', @$request->input ('datetime_end') . ":00"))
				: (is_null ($request->input ('datetime_end')) ? $results->Where ('Examples.datetime', '>=', @$request->input ('datetime_start') . ":00") : $results->whereBetween ('Examples.datetime', [@$request->input ('datetime_start') . ":00", @$request->input ('datetime_end') . ":00"])) : "" ;

				$results = $results->sortable()
				->paginate(config('core.paginate'));		
			}

		}else{
			$results = Example::select($select)->sortable()->paginate(config('core.paginate'));
			//$results = Example::all();
		}
		
		$compact = array();

		$compact['results'] = $results;
		$compact['arrShowField'] = $this->arrShowFieldIndex;
		
		$Examples = ['' => '']+App\Models\Example::where('id','!=',null)
			->orderBy('id')
			->pluck('Title','id')	
			->toArray();		
		$compact['Example'] = $Examples; 

		$Users = ['' => '']+App\Models\User::where('id','!=',null)
			->orderBy('id')
			->pluck('Name','id')	
			->toArray();		
		$compact['User'] = $Users; 

		$compact ['arrstatus'] = $this->arrstatus;
		$compact['request'] = $request->all();

		return view('examples.index',  $compact);
	}

	public function create(Request $request)
	{
		$compact = array();
		$Examples = ['' => '']+App\Models\Example::where('id','!=',null)
			->orderBy('id')
			->pluck('Title','id')	
			->toArray();			
		$compact['Example'] = $Examples;

		$Users = ['' => '']+App\Models\User::where('id','!=',null)
			->orderBy('id')
			->pluck('Name','id')	
			->toArray();			
		$compact['User'] = $Users;

		$compact['arrstatus'] = $this->arrstatus;

		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		return view('examples.add', $compact);	    
	}

	public function edit($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldFrom);

		$compact = array();
		
		$example = Example::select($select)->findOrFail($id);
		
		$compact['example'] = $example;
		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		$Examples = ['' => '']+App\Models\Example::where('id','!=',null)
			->where('id', '!=', $id)
			->orderBy('id')
			->pluck('Title','id')	
			->toArray();
			
		$compact['Example'] = $Examples; 
		$Users = ['' => '']+App\Models\User::where('id','!=',null)
			->orderBy('id')
			->pluck('Name','id')	
			->toArray();
			
		$compact['User'] = $Users; 
		$compact['arrstatus'] = $this->arrstatus;

		return view('examples.add', $compact);
	}

	public function show($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldView);

		$example = Example::select($select)->findOrFail($id);

		$compact['results'] = $example;
		$compact['arrShowFieldView'] = $this->arrShowFieldView;

		$Examples = App\Models\Example::where ('id', '!=', null)
			->orderBy ('id')
			->pluck ('Title', 'id')
			->toArray ();
		
		$compact['Example'] = $Examples; 
		$Users = App\Models\User::where ('id', '!=', null)
			->orderBy ('id')
			->pluck ('Name', 'id')
			->toArray ();
		
		$compact['User'] = $Users; 
		$compact['arrstatus'] = $this->arrstatus;

        return view('examples.show', $compact);
	}

	public function update(Request $request, $id) {
		
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['updated_uid'] = Auth::id();

        $example = Example::findOrFail($id);
		$results = $example->update($input);

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

        return redirect('/examples');
	}

	public function store(Request $request)
	{
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['created_uid'] = Auth::id();

        $example = Example::create($input);

		$lastInsertedId = $example->id;

		if ($example) {
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

		return redirect('/examples/'.$lastInsertedId.'/edit');
        //return redirect('/examples');
		//return $this->update($request);
	}

	public function destroy($id) {

		DB::beginTransaction();

		$isUse = $this->chkUse($id);

		if (!$isUse) {

			$example = Example::findOrFail($id);
			$results = $example->delete();

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
 * File Create : 2018-04-14 01:57:15 *
 */