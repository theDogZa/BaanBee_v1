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
use App\Models\Warehouse;
use Session;
use Cache;

use DB;

class WarehousesController extends Controller
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
		 'warehouse_name' => 1,  'warehouse_code' => 1,  'warehouse_address' => 1,  'province_id' => 1,  'warehouse_tel1' => 1,  'warehouse_tel2' => 1,  'warehouse_desc' => 1,  'active' => 1, 	
		];
		$this->arrShowFieldFrom = [
		 'warehouse_name' => 1,  'warehouse_code' => 1,  'warehouse_address' => 1,  'province_id' => 1,  'warehouse_tel1' => 1,  'warehouse_tel2' => 1,  'warehouse_desc' => 1,  'active' => 1, 
		];
		$this->arrShowFieldView = [
		 'warehouse_name' => 1,  'warehouse_code' => 1,  'warehouse_address' => 1,  'province_id' => 1,  'warehouse_tel1' => 1,  'warehouse_tel2' => 1,  'warehouse_desc' => 1,  'active' => 1, 	
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
			'warehouse_name' => 'required|string|max:255',
			'warehouse_code' => 'required|string|max:255',
			'warehouse_address' => 'required|string|max:255',
			'province_id' => 'required|string|max:255',
			//#Ex
			//'username' => 'required|string|max:20|unique:users,username,' . $data ['id'],
			//'email' => 'required|string|email|max:255|unique:users,email,' . $data ['id'],
			// 'password' => 'required|string|min:6|confirmed',
			//'password' => 'required|string|min:6',
		];
		
		$messages = [
			'warehouse_name.required' => trans('Warehouse.warehouse_name_required'),
			'warehouse_code.required' => trans('Warehouse.warehouse_code_required'),
			'warehouse_address.required' => trans('Warehouse.warehouse_address_required'),
			'province_id.required' => trans('Warehouse.province_id_required'),
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
				$results = Warehouse::select($select);
				//->join('tableA', 'warehouses.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'warehouses.tableB_id', '=', 'tableB.id')
				
				(!empty($this->arrShowFieldIndex['warehouse_name'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Warehouses.warehouse_name', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['warehouse_code'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Warehouses.warehouse_code', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['warehouse_address'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Warehouses.warehouse_address', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['province_id'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Warehouses.province_id', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['warehouse_tel1'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Warehouses.warehouse_tel1', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['warehouse_tel2'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Warehouses.warehouse_tel2', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['warehouse_desc'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Warehouses.warehouse_desc', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['active'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Warehouses.active', 'LIKE','%'. @$search.'%') : "" ;
				//$results = is_null ($search) ? $results : $results->orWhere ('tableA.columnName', 'LIKE','%'. @$search.'%') ;
				$results = $results->sortable()
				->paginate(config('core.paginate'));

			}else{

				$results = Warehouse::select($select);
				//->join('tableA', 'warehouses.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'warehouses.tableB_id', '=', 'tableB.id')
				//->select('warehouses.*', 'tableA.columnName', 'tableB.columnName');
				(!empty( $this->arrShowFieldIndex['warehouse_name'] ))? $results = is_null ($request->input ('warehouse_name')) ? $results : $results->Where ('Warehouses.warehouse_name', 'LIKE', @$request->input ('warehouse_name')) : "" ;
				(!empty( $this->arrShowFieldIndex['warehouse_code'] ))? $results = is_null ($request->input ('warehouse_code')) ? $results : $results->Where ('Warehouses.warehouse_code', 'LIKE', @$request->input ('warehouse_code')) : "" ;
				(!empty( $this->arrShowFieldIndex['warehouse_address'] ))? $results = is_null ($request->input ('warehouse_address')) ? $results : $results->Where ('Warehouses.warehouse_address', 'LIKE', @$request->input ('warehouse_address')) : "" ;
				(!empty( $this->arrShowFieldIndex['province_id'] ))? $results = is_null ($request->input ('province_id')) ? $results : $results->Where ('Warehouses.province_id', '=', @$request->input ('province_id')) : "" ;
				(!empty( $this->arrShowFieldIndex['warehouse_tel1'] ))? $results = is_null ($request->input ('warehouse_tel1')) ? $results : $results->Where ('Warehouses.warehouse_tel1', 'LIKE', @$request->input ('warehouse_tel1')) : "" ;
				(!empty( $this->arrShowFieldIndex['warehouse_tel2'] ))? $results = is_null ($request->input ('warehouse_tel2')) ? $results : $results->Where ('Warehouses.warehouse_tel2', 'LIKE', @$request->input ('warehouse_tel2')) : "" ;
				(!empty( $this->arrShowFieldIndex['warehouse_desc'] ))? $results = is_null ($request->input ('warehouse_desc')) ? $results : $results->Where ('Warehouses.warehouse_desc', 'LIKE', @$request->input ('warehouse_desc')) : "" ;
				(!empty( $this->arrShowFieldIndex['active'] ))? $results = is_null ($request->input ('active')) ? $results : $results->Where('Warehouses.active', '=', @$request->input ('active')) : "" ;

				$results = $results->sortable()
				->paginate(config('core.paginate'));		
			}

		}else{
			$results = Warehouse::select($select)->sortable()->paginate(config('core.paginate'));
			//$results = Warehouse::all();
		}
		
		$compact = array();

		$compact['results'] = $results;
		$compact['arrShowField'] = $this->arrShowFieldIndex;
		
		$Provinces = ['' => '']+App\Models\Province::where('id','!=',null)
			->orderBy('id')
			->pluck('province_name_th','id')	
			->toArray();
			
		$compact['Province'] = $Provinces; 

		$compact['request'] = $request->all();

		return view('warehouses.index',  $compact);
	}

	public function create(Request $request)
	{
		$compact = array();
		$Provinces = ['' => '']+App\Models\Province::where('id','!=',null)
			->orderBy('province_name_th')
			->pluck('province_name_th','id')	
			->toArray();			
		$compact['Province'] = $Provinces;


		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		return view('warehouses.add', $compact);	    
	}

	public function edit($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldFrom);

		$compact = array();
		
		$warehouse = Warehouse::select($select)->findOrFail($id);
		
		$compact['warehouse'] = $warehouse;
		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		$Provinces = ['' => '']+App\Models\Province::where('id','!=',null)
			->orderBy('province_name_th')
			->pluck('province_name_th','id')	
			->toArray();			
		$compact['Province'] = $Provinces; 


		return view('warehouses.add', $compact);
	}

	public function show($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldView);

		$warehouse = Warehouse::select($select)->findOrFail($id);

		$compact['results'] = $warehouse;
		$compact['arrShowFieldView'] = $this->arrShowFieldView;

		$Provinces = App\Models\Province::where ('id', '!=', null)
			->orderBy ('id')
			->pluck ('province_name_th', 'id')
			->toArray ();		
		$compact['Province'] = $Provinces;
		

        return view('warehouses.show', $compact);
	}

	public function update(Request $request, $id) {
		
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['updated_uid'] = Auth::id();

        $warehouse = Warehouse::findOrFail($id);
		$results = $warehouse->update($input);

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
        
        return redirect('/warehouses');
	}

	public function store(Request $request)
	{
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['created_uid'] = Auth::id();

        $warehouse = Warehouse::create($input);

		$lastInsertedId = $warehouse->id;

		if ($warehouse) {
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

		return redirect('/warehouses/'.$lastInsertedId.'/edit');
        //return redirect('/warehouses');
		//return $this->update($request);
	}

	public function destroy($id) {

		DB::beginTransaction();

		$isUse = $this->chkUse($id);

		if (!$isUse) {

			$warehouse = Warehouse::findOrFail($id);
			$results = $warehouse->delete();

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
 * File Create : 2018-05-15 22:39:53 *
 */