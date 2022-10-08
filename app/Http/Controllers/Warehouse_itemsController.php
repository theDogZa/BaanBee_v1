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
use App\Models\Warehouse_item;
use Session;
use Cache;

use DB;

class Warehouse_itemsController extends Controller
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
		 'warehouse_id' => 1,  'item_id' => 1,  'qty' => 1,  'min_qty' => 1,  'max_qty' => 1,  'warehouse_item_desc' => 0,  'active' => 1, 	
		];
		$this->arrShowFieldFrom = [
		 'warehouse_id' => 1,  'item_id' => 1,  'qty' => 1,  'min_qty' => 1,  'max_qty' => 1,  'warehouse_item_desc' => 1,  'active' => 1, 
		];
		$this->arrShowFieldView = [
		 'warehouse_id' => 1,  'item_id' => 1,  'qty' => 1,  'min_qty' => 1,  'max_qty' => 1,  'warehouse_item_desc' => 1,  'active' => 1, 	
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
			'warehouse_id' => 'required|string|max:255',
			'item_id' => 'required|string|max:255',
			'qty' => 'required|string|max:255',
			//#Ex
			//'username' => 'required|string|max:20|unique:users,username,' . $data ['id'],
			//'email' => 'required|string|email|max:255|unique:users,email,' . $data ['id'],
			// 'password' => 'required|string|min:6|confirmed',
			//'password' => 'required|string|min:6',
		];
		
		$messages = [
			'warehouse_id.required' => trans('Warehouse_item.warehouse_id_required'),
			'item_id.required' => trans('Warehouse_item.item_id_required'),
			'qty.required' => trans('Warehouse_item.qty_required'),
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
				$results = Warehouse_item::select($select);
				//->join('tableA', 'warehouse_items.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'warehouse_items.tableB_id', '=', 'tableB.id')
				
				(!empty($this->arrShowFieldIndex['warehouse_id'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Warehouse_items.warehouse_id', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['item_id'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Warehouse_items.item_id', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['qty'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Warehouse_items.qty', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['min_qty'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Warehouse_items.min_qty', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['max_qty'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Warehouse_items.max_qty', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['warehouse_item_desc'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Warehouse_items.warehouse_item_desc', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['active'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Warehouse_items.active', 'LIKE','%'. @$search.'%') : "" ;
				//$results = is_null ($search) ? $results : $results->orWhere ('tableA.columnName', 'LIKE','%'. @$search.'%') ;
				$results = $results->sortable()
				->paginate(config('core.paginate'));

			}else{

				$results = Warehouse_item::select($select);
				//->join('tableA', 'warehouse_items.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'warehouse_items.tableB_id', '=', 'tableB.id')
				//->select('warehouse_items.*', 'tableA.columnName', 'tableB.columnName');
				(!empty( $this->arrShowFieldIndex['warehouse_id'] ))? $results = is_null ($request->input ('warehouse_id')) ? $results : $results->Where ('Warehouse_items.warehouse_id', '=', @$request->input ('warehouse_id')) : "" ;
				(!empty( $this->arrShowFieldIndex['item_id'] ))? $results = is_null ($request->input ('item_id')) ? $results : $results->Where ('Warehouse_items.item_id', '=', @$request->input ('item_id')) : "" ;
 
				(!empty($this->arrShowFieldIndex ['qty'])) ? $results = is_null ($request->input ('qty_start')) ? (is_null ($request->input ('qty_end')) ? $results : $results->Where ('Warehouse_items.qty', '<=', @$request->input ('qty_end')))
				: (is_null ($request->input ('qty_end')) ? $results->Where ('Warehouse_items.qty', '>=', @$request->input ('qty_start')) : $results->whereBetween ('Warehouse_items.qty', [@$request->input ('qty_start'), @$request->input ('qty_end')])) : "" ;
 
				(!empty($this->arrShowFieldIndex ['min_qty'])) ? $results = is_null ($request->input ('min_qty_start')) ? (is_null ($request->input ('min_qty_end')) ? $results : $results->Where ('Warehouse_items.min_qty', '<=', @$request->input ('min_qty_end')))
				: (is_null ($request->input ('min_qty_end')) ? $results->Where ('Warehouse_items.min_qty', '>=', @$request->input ('min_qty_start')) : $results->whereBetween ('Warehouse_items.min_qty', [@$request->input ('min_qty_start'), @$request->input ('min_qty_end')])) : "" ;
 
				(!empty($this->arrShowFieldIndex ['max_qty'])) ? $results = is_null ($request->input ('max_qty_start')) ? (is_null ($request->input ('max_qty_end')) ? $results : $results->Where ('Warehouse_items.max_qty', '<=', @$request->input ('max_qty_end')))
				: (is_null ($request->input ('max_qty_end')) ? $results->Where ('Warehouse_items.max_qty', '>=', @$request->input ('max_qty_start')) : $results->whereBetween ('Warehouse_items.max_qty', [@$request->input ('max_qty_start'), @$request->input ('max_qty_end')])) : "" ;
				(!empty( $this->arrShowFieldIndex['warehouse_item_desc'] ))? $results = is_null ($request->input ('warehouse_item_desc')) ? $results : $results->Where ('Warehouse_items.warehouse_item_desc', 'LIKE', @$request->input ('warehouse_item_desc')) : "" ;
				(!empty( $this->arrShowFieldIndex['active'] ))? $results = is_null ($request->input ('active')) ? $results : $results->Where('Warehouse_items.active', '=', @$request->input ('active')) : "" ;

				$results = $results->sortable()
				->paginate(config('core.paginate'));		
			}

		}else{
			$results = Warehouse_item::select($select)->sortable()->paginate(config('core.paginate'));
			//$results = Warehouse_item::all();
		}
		
		$compact = array();

		$compact['results'] = $results;
		$compact['arrShowField'] = $this->arrShowFieldIndex;
		
		$Warehouses = ['' => '']+App\Models\Warehouse::where('id','!=',null)
			->select(DB::raw("CONCAT(warehouse_code,' ',warehouse_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name','id')	
			->toArray();
			
		$compact['Warehouse'] = $Warehouses; 

		$Items = ['' => '']+App\Models\Item::where('id','!=',null)
			->select(DB::raw("CONCAT(item_code,' ',item_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name','id')	
			->toArray();
			
		$compact['Item'] = $Items; 

		$compact['request'] = $request->all();

		return view('warehouse_items.index',  $compact);
	}

	public function create(Request $request)
	{
		$compact = array();
		$Warehouses = ['' => '']+App\Models\Warehouse::where('id','!=',null)
			->select(DB::raw("CONCAT(warehouse_code,' ',warehouse_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name','id')	
			->toArray();			
		$compact['Warehouse'] = $Warehouses;

		$Items = ['' => '']+App\Models\Item::where('id','!=',null)
			->select(DB::raw("CONCAT(item_code,' ',item_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name', 'id')
			->toArray();			
		$compact['Item'] = $Items;


		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		return view('warehouse_items.add', $compact);	    
	}

	public function edit($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldFrom);

		$compact = array();
		
		$warehouse_item = Warehouse_item::select($select)->findOrFail($id);
		
		$compact['warehouse_item'] = $warehouse_item;
		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		$Warehouses = ['' => '']+App\Models\Warehouse::where('id','!=',null)
			->select(DB::raw("CONCAT(warehouse_code,' ',warehouse_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name','id')	
			->toArray();			
		$compact['Warehouse'] = $Warehouses; 

		$Items = ['' => '']+App\Models\Item::where('id','!=',null)
			->select(DB::raw("CONCAT(item_code,' ',item_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name', 'id')
			->toArray();			
		$compact['Item'] = $Items; 


		return view('warehouse_items.add', $compact);
	}

	public function show($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldView);

		$warehouse_item = Warehouse_item::select($select)->findOrFail($id);

		$compact['results'] = $warehouse_item;
		$compact['arrShowFieldView'] = $this->arrShowFieldView;

		$Warehouses = App\Models\Warehouse::where ('id', '!=', null)
			->select(DB::raw("CONCAT(warehouse_code,' ',warehouse_name) AS name"), 'id')
			->orderBy ('id')
			->pluck ('name', 'id')
			->toArray ();		
		$compact['Warehouse'] = $Warehouses;
		
		$Items = App\Models\Item::where ('id', '!=', null)
			->select(DB::raw("CONCAT(item_code,' ',item_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name', 'id')
			->toArray();		
		$compact['Item'] = $Items;
		

        return view('warehouse_items.show', $compact);
	}

	public function update(Request $request, $id) {
		
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['updated_uid'] = Auth::id();

        $warehouse_item = Warehouse_item::findOrFail($id);
		$results = $warehouse_item->update($input);

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
        
        return redirect('/warehouse_items');
	}

	public function store(Request $request)
	{
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['created_uid'] = Auth::id();

        $warehouse_item = Warehouse_item::create($input);

		$lastInsertedId = $warehouse_item->id;

		if ($warehouse_item) {
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

		return redirect('/warehouse_items/'.$lastInsertedId.'/edit');
        //return redirect('/warehouse_items');
		//return $this->update($request);
	}

	public function destroy($id) {

		DB::beginTransaction();

		$isUse = $this->chkUse($id);

		if (!$isUse) {

			$warehouse_item = Warehouse_item::findOrFail($id);
			$results = $warehouse_item->delete();

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
 * File Create : 2018-05-15 22:59:05 *
 */