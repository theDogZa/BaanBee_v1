<?php

namespace [[appns]]Http\Controllers;

use Illuminate\Http\Request;

use [[appns]]Http\Requests;
use [[appns]]Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

use App;
use App\Models;
use [[appns]]Models\[[model_uc]];
use Session;
use Cache;

use DB;

class [[controller_name]]Controller extends Controller
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
		[[foreach:columns_index]] '[[i.name]]' => [[i.col_show]], [[endforeach]]
	
		];
		$this->arrShowFieldFrom = [
		[[foreach:columns_index]] '[[i.name]]' => [[i.col_show]], [[endforeach]]

		];
		$this->arrShowFieldView = [
		[[foreach:columns_index]] '[[i.name]]' => [[i.col_show]], [[endforeach]]
	
		];

		[[foreach:columns_index]]
		[[if:i.type == 'radio']]

		//arr val for [[i.name]] to Radio, CheckBox and Select
		$this->arr[[i.name]] = ['1','2'];
		[[endif]]
		[[endforeach]]

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
[[foreach:columns_index]]
[[if:i.required == 'required']]
			'[[i.name]]' => 'required|string|max:255',
[[endif]]
[[endforeach]]
			//#Ex
			//'username' => 'required|string|max:20|unique:users,username,' . $data ['id'],
			//'email' => 'required|string|email|max:255|unique:users,email,' . $data ['id'],
			// 'password' => 'required|string|min:6|confirmed',
			//'password' => 'required|string|min:6',
		];
		
		$messages = [
[[foreach:columns_index]]
[[if:i.required == 'required']]
			'[[i.name]].required' => trans('[[model_uc]].[[i.name]]_required'),
[[endif]]
[[endforeach]]
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
				$results = [[model_uc]]::select($select);
				//->join('tableA', '[[prefix]][[tablename]].tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', '[[prefix]][[tablename]].tableB_id', '=', 'tableB.id')
				
[[foreach:columns_index]]
[[if:i.name != 'id']]
				(!empty($this->arrShowFieldIndex['[[i.name]]'] ))? $results = is_null ($search) ? $results : $results->orWhere ('[[model_uc_plural]].[[i.name]]', 'LIKE','%'. @$search.'%') : "" ;
[[endif]]
[[endforeach]]
				//$results = is_null ($search) ? $results : $results->orWhere ('tableA.columnName', 'LIKE','%'. @$search.'%') ;
				$results = $results->sortable()
				->paginate(config('core.paginate'));

			}else{

				$results = [[model_uc]]::select($select);
				//->join('tableA', '[[prefix]][[tablename]].tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', '[[prefix]][[tablename]].tableB_id', '=', 'tableB.id')
				//->select('[[prefix]][[tablename]].*', 'tableA.columnName', 'tableB.columnName');
[[foreach:columns_index]]
[[if:i.type == 'select']]
				(!empty( $this->arrShowFieldIndex['[[i.name]]'] ))? $results = is_null ($request->input ('[[i.name]]')) ? $results : $results->Where ('[[model_uc_plural]].[[i.name]]', '=', @$request->input ('[[i.name]]')) : "" ;
[[endif]]
[[if:i.type == 'text']]
				(!empty( $this->arrShowFieldIndex['[[i.name]]'] ))? $results = is_null ($request->input ('[[i.name]]')) ? $results : $results->Where ('[[model_uc_plural]].[[i.name]]', 'LIKE', @$request->input ('[[i.name]]')) : "" ;
[[endif]]
[[if:i.type == 'number']] 
				(!empty($this->arrShowFieldIndex ['[[i.name]]'])) ? $results = is_null ($request->input ('[[i.name]]_start')) ? (is_null ($request->input ('[[i.name]]_end')) ? $results : $results->Where ('[[model_uc_plural]].[[i.name]]', '<=', @$request->input ('[[i.name]]_end')))
				: (is_null ($request->input ('[[i.name]]_end')) ? $results->Where ('[[model_uc_plural]].[[i.name]]', '>=', @$request->input ('[[i.name]]_start')) : $results->whereBetween ('[[model_uc_plural]].[[i.name]]', [@$request->input ('[[i.name]]_start'), @$request->input ('[[i.name]]_end')])) : "" ;
[[endif]]
[[if:i.type == 'textarea']]
				(!empty( $this->arrShowFieldIndex['[[i.name]]'] ))? $results = is_null ($request->input ('[[i.name]]')) ? $results : $results->Where ('[[model_uc_plural]].[[i.name]]', 'LIKE', @$request->input ('[[i.name]]')) : "" ;
[[endif]]
[[if:i.type == 'radio_active']]
				(!empty( $this->arrShowFieldIndex['[[i.name]]'] ))? $results = is_null ($request->input ('[[i.name]]')) ? $results : $results->Where('[[model_uc_plural]].[[i.name]]', '=', @$request->input ('[[i.name]]')) : "" ;
[[endif]]
[[if:i.type == 'radio']]
				(!empty( $this->arrShowFieldIndex['[[i.name]]'] ))? $results = is_null ($request->input ('[[i.name]]')) ? $results : $results->Where('[[model_uc_plural]].[[i.name]]', '=', @$request->input ('[[i.name]]')) : "" ;
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type == 'date']]
				(!empty( $this->arrShowFieldIndex['[[i.name]]'] ))? $results = is_null ($request->input ('[[i.name]]_start')) ? (is_null ($request->input ('[[i.name]]_end')) ? $results : $results->Where ('[[model_uc_plural]].[[i.name]]', '<=', @$request->input ('[[i.name]]_end')))
				: (is_null ($request->input ('[[i.name]]_end')) ? $results->Where ('[[model_uc_plural]].[[i.name]]', '>=', @$request->input ('[[i.name]]_start')) : $results->whereBetween ('[[model_uc_plural]].[[i.name]]', [@$request->input ('[[i.name]]_start'), @$request->input ('[[i.name]]_end')])) : "" ;
[[endif]]
[[if:i.type == 'time']]
				(!empty( $this->arrShowFieldIndex['[[i.name]]'] ))? $results = is_null ($request->input ('[[i.name]]_start')) ? (is_null ($request->input ('[[i.name]]_end')) ? $results : $results->Where ('[[model_uc_plural]].[[i.name]]', '<=', @$request->input ('[[i.name]]_end') . ":00"))
				: (is_null ($request->input ('[[i.name]]_end')) ? $results->Where ('[[model_uc_plural]].[[i.name]]', '>=', @$request->input ('[[i.name]]_start') . ":00") : $results->whereBetween ('[[model_uc_plural]].[[i.name]]', [@$request->input ('[[i.name]]_start') . ":00", @$request->input ('[[i.name]]_end') . ":00"])) : "" ;
[[endif]]
[[if:i.type == 'datetime']]
				(!empty( $this->arrShowFieldIndex['[[i.name]]'] ))? $results = is_null ($request->input ('[[i.name]]_start')) ? (is_null ($request->input ('[[i.name]]_end')) ? $results : $results->Where ('[[model_uc_plural]].[[i.name]]', '<=', @$request->input ('[[i.name]]_end') . ":00"))
				: (is_null ($request->input ('[[i.name]]_end')) ? $results->Where ('[[model_uc_plural]].[[i.name]]', '>=', @$request->input ('[[i.name]]_start') . ":00") : $results->whereBetween ('[[model_uc_plural]].[[i.name]]', [@$request->input ('[[i.name]]_start') . ":00", @$request->input ('[[i.name]]_end') . ":00"])) : "" ;
[[endif]]
[[if:i.type == 'unknown']]
				(!empty( $this->arrShowFieldIndex['[[i.name]]'] ))? $results = is_null ($request->input ('[[i.name]]')) ? $results : $results->Where ('[[model_uc_plural]].[[i.name]]', 'LIKE', @$request->input ('[[i.name]]')) : "" ;
[[endif]]
[[endforeach]]

				$results = $results->sortable()
				->paginate(config('core.paginate'));		
			}

		}else{
			$results = [[model_uc]]::select($select)->sortable()->paginate(config('core.paginate'));
			//$results = [[model_uc]]::all();
		}
		
		$compact = array();

		$compact['results'] = $results;
		$compact['arrShowField'] = $this->arrShowFieldIndex;
		
[[foreach:columns_index]]
[[if:i.type=='select']]
		$[[i.model_select]]s = ['' => '']+App\Models\[[i.model_select]]::where('id','!=',null)
			->orderBy('id')
			->pluck('id','id')	
			->toArray();
			
		$compact['[[i.model_select]]'] = $[[i.model_select]]s; 

[[endif]]
[[if:i.type == 'radio']]
		$compact ['arr[[i.name]]'] = $this->arr[[i.name]];
[[endif]]
[[endforeach]]
		$compact['request'] = $request->all();

		return view('[[view_folder]].index',  $compact);
	}

	public function create(Request $request)
	{
		$compact = array();
[[foreach:columns_index]]
[[if:i.type=='select']]
		$[[i.model_select]]s = ['' => '']+App\Models\[[i.model_select]]::where('id','!=',null)
			->orderBy('id')
			->pluck('id','id')	
			->toArray();			
		$compact['[[i.model_select]]'] = $[[i.model_select]]s;

[[endif]]
[[if:i.type == 'radio']]
		$compact['arr[[i.name]]'] = $this->arr[[i.name]];
[[endif]]
[[endforeach]]

		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		return view('[[view_folder]].add', $compact);	    
	}

	public function edit($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldFrom);

		$compact = array();
		
		$[[model_singular]] = [[model_uc]]::select($select)->findOrFail($id);
		
		$compact['[[model_singular]]'] = $[[model_singular]];
		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

[[foreach:columns_index]]
[[if:i.type=='select']]
		$[[i.model_select]]s = ['' => '']+App\Models\[[i.model_select]]::where('id','!=',null)
			->orderBy('id')
			->pluck('id','id')	
			->toArray();			
		$compact['[[i.model_select]]'] = $[[i.model_select]]s; 

[[endif]]
[[if:i.type == 'radio']]
		$compact['arr[[i.name]]'] = $this->arr[[i.name]];
[[endif]]
[[endforeach]]

		return view('[[view_folder]].add', $compact);
	}

	public function show($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldView);

		$[[model_singular]] = [[model_uc]]::select($select)->findOrFail($id);

		$compact['results'] = $[[model_singular]];
		$compact['arrShowFieldView'] = $this->arrShowFieldView;

[[foreach:columns_index]]
[[if:i.type == 'select']]
		$[[i.model_select]]s = App\Models\[[i.model_select]]::where ('id', '!=', null)
			->orderBy ('id')
			->pluck ('id', 'id')
			->toArray ();		
		$compact['[[i.model_select]]'] = $[[i.model_select]]s;
		
[[endif]]
[[if:i.type == 'radio']]
		$compact['arr[[i.name]]'] = $this->arr[[i.name]];
[[endif]]
[[endforeach]]

        return view('[[view_folder]].show', $compact);
	}

	public function update(Request $request, $id) {
		
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['updated_uid'] = Auth::id();

        $[[model_singular]] = [[model_uc]]::findOrFail($id);
		$results = $[[model_singular]]->update($input);

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
        
        return redirect('/[[route_path]]');
	}

	public function store(Request $request)
	{
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['created_uid'] = Auth::id();

        $[[model_singular]] = [[model_uc]]::create($input);

		$lastInsertedId = $[[model_singular]]->id;

		if ($[[model_singular]]) {
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

		return redirect('/[[route_path]]/'.$lastInsertedId.'/edit');
        //return redirect('/[[route_path]]');
		//return $this->update($request);
	}

	public function destroy($id) {

		DB::beginTransaction();

		$isUse = $this->chkUse($id);

		if (!$isUse) {

			$[[model_singular]] = [[model_uc]]::findOrFail($id);
			$results = $[[model_singular]]->delete();

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
 * File Create : [[datetimenow]]
 *
 */