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
use App\Models\Item;
use Session;
use Cache;

use DB;

class ItemsController extends Controller
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
		 'item_categorie_id' => 1,  'item_size_id' => 1,  'item_color_id' => 1,  'item_unit_id' => 0,  'item_name' => 1,  'item_code' => 1,  'item_num' => 1,  'item_sale_price' => 1,  'item_cost_price' => 0,  'item_qty' => 1,  'item_qty_min' => 0,  'item_qty_max' => 0,  'item_sale_qty' => 1,  'item_desc' => 0,  'active' => 1, 	
		];
		$this->arrShowFieldFrom = [
		 'item_categorie_id' => 1,  'item_size_id' => 1,  'item_color_id' => 1,  'item_unit_id' => 1,  'item_name' => 1,  'item_code' => 1,  'item_num' => 1,  'item_sale_price' => 1,  'item_cost_price' => 1,  'item_qty' => 1,  'item_qty_min' => 1,  'item_qty_max' => 1,  'item_sale_qty' => 0,  'item_desc' => 1,  'active' => 1, 
		];
		$this->arrShowFieldView = [
		 'item_categorie_id' => 1,  'item_size_id' => 1,  'item_color_id' => 1,  'item_unit_id' => 1,  'item_name' => 1,  'item_code' => 1,  'item_num' => 1,  'item_sale_price' => 1,  'item_cost_price' => 1,  'item_qty' => 1,  'item_qty_min' => 1,  'item_qty_max' => 1,  'item_sale_qty' => 1,  'item_desc' => 1,  'active' => 1, 	
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
			'item_categorie_id' => 'required|string|max:255',
			'item_size_id' => 'required|string|max:255',
			'item_color_id' => 'required|string|max:255',
			'item_unit_id' => 'required|string|max:255',
			'item_name' => 'required|string|max:255',
			'item_code' => 'required|string|max:255',
			'item_num' => 'required|string|max:255',
			'item_sale_price' => 'required|string|max:255',
			//#Ex
			//'username' => 'required|string|max:20|unique:users,username,' . $data ['id'],
			//'email' => 'required|string|email|max:255|unique:users,email,' . $data ['id'],
			// 'password' => 'required|string|min:6|confirmed',
			//'password' => 'required|string|min:6',
		];
		
		$messages = [
			'item_categorie_id.required' => trans('Item.item_categorie_id_required'),
			'item_size_id.required' => trans('Item.item_size_id_required'),
			'item_color_id.required' => trans('Item.item_color_id_required'),
			'item_unit_id.required' => trans('Item.item_unit_id_required'),
			'item_name.required' => trans('Item.item_name_required'),
			'item_code.required' => trans('Item.item_code_required'),
			'item_num.required' => trans('Item.item_num_required'),
			'item_sale_price.required' => trans('Item.item_sale_price_required'),
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
				$results = Item::select($select);
				//->join('tableA', 'items.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'items.tableB_id', '=', 'tableB.id')
				
				(!empty($this->arrShowFieldIndex['item_categorie_id'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Items.item_categorie_id', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['item_size_id'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Items.item_size_id', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['item_color_id'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Items.item_color_id', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['item_unit_id'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Items.item_unit_id', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['item_name'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Items.item_name', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['item_code'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Items.item_code', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['item_num'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Items.item_num', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['item_sale_price'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Items.item_sale_price', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['item_cost_price'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Items.item_cost_price', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['item_qty'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Items.item_qty', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['item_qty_min'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Items.item_qty_min', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['item_qty_max'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Items.item_qty_max', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['item_sale_qty'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Items.item_sale_qty', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['item_desc'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Items.item_desc', 'LIKE','%'. @$search.'%') : "" ;
				(!empty($this->arrShowFieldIndex['active'] ))? $results = is_null ($search) ? $results : $results->orWhere ('Items.active', 'LIKE','%'. @$search.'%') : "" ;
				//$results = is_null ($search) ? $results : $results->orWhere ('tableA.columnName', 'LIKE','%'. @$search.'%') ;
				$results = $results->sortable()
				->paginate(config('core.paginate'));

			}else{

				$results = Item::select($select);
				//->join('tableA', 'items.tableA_id', '=', 'tableA.id')
				//->leftJoin('tableB', 'items.tableB_id', '=', 'tableB.id')
				//->select('items.*', 'tableA.columnName', 'tableB.columnName');
				(!empty( $this->arrShowFieldIndex['item_categorie_id'] ))? $results = is_null ($request->input ('item_categorie_id')) ? $results : $results->Where ('Items.item_categorie_id', '=', @$request->input ('item_categorie_id')) : "" ;
				(!empty( $this->arrShowFieldIndex['item_size_id'] ))? $results = is_null ($request->input ('item_size_id')) ? $results : $results->Where ('Items.item_size_id', '=', @$request->input ('item_size_id')) : "" ;
				(!empty( $this->arrShowFieldIndex['item_color_id'] ))? $results = is_null ($request->input ('item_color_id')) ? $results : $results->Where ('Items.item_color_id', '=', @$request->input ('item_color_id')) : "" ;
				(!empty( $this->arrShowFieldIndex['item_unit_id'] ))? $results = is_null ($request->input ('item_unit_id')) ? $results : $results->Where ('Items.item_unit_id', '=', @$request->input ('item_unit_id')) : "" ;
				(!empty( $this->arrShowFieldIndex['item_name'] ))? $results = is_null ($request->input ('item_name')) ? $results : $results->Where ('Items.item_name', 'LIKE', @$request->input ('item_name')) : "" ;
				(!empty( $this->arrShowFieldIndex['item_code'] ))? $results = is_null ($request->input ('item_code')) ? $results : $results->Where ('Items.item_code', 'LIKE', @$request->input ('item_code')) : "" ;
				(!empty( $this->arrShowFieldIndex['item_num'] ))? $results = is_null ($request->input ('item_num')) ? $results : $results->Where ('Items.item_num', 'LIKE', @$request->input ('item_num')) : "" ;
				(!empty($this->arrShowFieldIndex ['item_sale_price'])) ? $results = is_null ($request->input ('item_sale_price_start')) ? (is_null ($request->input ('item_sale_price_end')) ? $results : $results->Where ('Items.item_sale_price', '<=', @$request->input ('item_sale_price_end')))
				: (is_null ($request->input ('item_sale_price_end')) ? $results->Where ('Items.item_sale_price', '>=', @$request->input ('item_sale_price_start')) : $results->whereBetween ('Items.item_sale_price', [@$request->input ('item_sale_price_start'), @$request->input ('item_sale_price_end')])) : "" ;
				(!empty($this->arrShowFieldIndex ['item_cost_price'])) ? $results = is_null ($request->input ('item_cost_price_start')) ? (is_null ($request->input ('item_cost_price_end')) ? $results : $results->Where ('Items.item_cost_price', '<=', @$request->input ('item_cost_price_end')))
				: (is_null ($request->input ('item_cost_price_end')) ? $results->Where ('Items.item_cost_price', '>=', @$request->input ('item_cost_price_start')) : $results->whereBetween ('Items.item_cost_price', [@$request->input ('item_cost_price_start'), @$request->input ('item_cost_price_end')])) : "" ;
				(!empty($this->arrShowFieldIndex ['item_qty'])) ? $results = is_null ($request->input ('item_qty_start')) ? (is_null ($request->input ('item_qty_end')) ? $results : $results->Where ('Items.item_qty', '<=', @$request->input ('item_qty_end')))
				: (is_null ($request->input ('item_qty_end')) ? $results->Where ('Items.item_qty', '>=', @$request->input ('item_qty_start')) : $results->whereBetween ('Items.item_qty', [@$request->input ('item_qty_start'), @$request->input ('item_qty_end')])) : "" ;
				(!empty($this->arrShowFieldIndex ['item_qty_min'])) ? $results = is_null ($request->input ('item_qty_min_start')) ? (is_null ($request->input ('item_qty_min_end')) ? $results : $results->Where ('Items.item_qty_min', '<=', @$request->input ('item_qty_min_end')))
				: (is_null ($request->input ('item_qty_min_end')) ? $results->Where ('Items.item_qty_min', '>=', @$request->input ('item_qty_min_start')) : $results->whereBetween ('Items.item_qty_min', [@$request->input ('item_qty_min_start'), @$request->input ('item_qty_min_end')])) : "" ;
				(!empty($this->arrShowFieldIndex ['item_qty_max'])) ? $results = is_null ($request->input ('item_qty_max_start')) ? (is_null ($request->input ('item_qty_max_end')) ? $results : $results->Where ('Items.item_qty_max', '<=', @$request->input ('item_qty_max_end')))
				: (is_null ($request->input ('item_qty_max_end')) ? $results->Where ('Items.item_qty_max', '>=', @$request->input ('item_qty_max_start')) : $results->whereBetween ('Items.item_qty_max', [@$request->input ('item_qty_max_start'), @$request->input ('item_qty_max_end')])) : "" ;
				(!empty($this->arrShowFieldIndex ['item_sale_qty'])) ? $results = is_null ($request->input ('item_sale_qty_start')) ? (is_null ($request->input ('item_sale_qty_end')) ? $results : $results->Where ('Items.item_sale_qty', '<=', @$request->input ('item_sale_qty_end')))
				: (is_null ($request->input ('item_sale_qty_end')) ? $results->Where ('Items.item_sale_qty', '>=', @$request->input ('item_sale_qty_start')) : $results->whereBetween ('Items.item_sale_qty', [@$request->input ('item_sale_qty_start'), @$request->input ('item_sale_qty_end')])) : "" ;
				(!empty( $this->arrShowFieldIndex['item_desc'] ))? $results = is_null ($request->input ('item_desc')) ? $results : $results->Where ('Items.item_desc', 'LIKE', @$request->input ('item_desc')) : "" ;
				(!empty( $this->arrShowFieldIndex['active'] ))? $results = is_null ($request->input ('active')) ? $results : $results->Where('Items.active', '=', @$request->input ('active')) : "" ;

				$results = $results->sortable()
				->paginate(config('core.paginate'));		
			}

		}else{
			$results = Item::select($select)->sortable()->paginate(config('core.paginate'));
			//$results = Item::all();
		}
		
		$compact = array();

		$compact['results'] = $results;
		$compact['arrShowField'] = $this->arrShowFieldIndex;
		
		$Item_categorys = ['' => '']+Models\Item_category::where('id','!=',null)
			->select(DB::raw("CONCAT(categories_code,' - ',categories_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name','id')	
			->toArray();
			
		$compact['Item_category'] = $Item_categorys; 

		$Item_sizes = ['' => '']+App\Models\Item_size::where('id','!=',null)
			->select(DB::raw("CONCAT(size_code,' - ',size_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name','id')	
			->toArray();
			
		$compact['Item_size'] = $Item_sizes; 

		$Item_colors = ['' => '']+App\Models\Item_color::where('id','!=',null)
			->select(DB::raw("CONCAT(color_code,' - ',color_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name','id')	
			->toArray();
		
		$compact['Item_color'] = $Item_colors; 

		$Item_units = ['' => '']+App\Models\Item_unit::where('id','!=',null)
			->orderBy('id')
			->pluck('unit_name','id')	
			->toArray();
			
		$compact['Item_unit'] = $Item_units; 

		$compact['request'] = $request->all();

		return view('items.index',  $compact);
	}

	public function create(Request $request)
	{
		$compact = array();
		$Item_categorys = ['' => '']+App\Models\Item_category::where('id','!=',null)
			->select(DB::raw("CONCAT(categories_code,' - ',categories_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name','id')	
			->toArray();			
		$compact['Item_category'] = $Item_categorys;

		$Item_sizes = ['' => '']+App\Models\Item_size::where('id','!=',null)
			->select(DB::raw("CONCAT(size_code,' - ',size_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name','id')	
			->toArray();			
		$compact['Item_size'] = $Item_sizes;

		$Item_colors = ['' => '']+App\Models\Item_color::where('id','!=',null)
			->select(DB::raw("CONCAT(color_code,' - ',color_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name','id')	
			->toArray();			
		$compact['Item_color'] = $Item_colors;	

		$Item_units = ['' => '']+App\Models\Item_unit::where('active','!=',0)
			->orderBy('id')
			->pluck('unit_name','id')	
			->toArray();			
		$compact['Item_unit'] = $Item_units;

		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		return view('items.add', $compact);	    
	}

	public function edit($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldFrom);

		$compact = array();
		
		$item = Item::select($select)->findOrFail($id);
		
		if(empty($item['item_qty'])) $item['item_qty'] = 0;
		
		$compact['item'] = $item;
		$compact['arrShowFieldFrom'] = $this->arrShowFieldFrom;

		$Item_categorys = ['' => '']+App\Models\Item_category::where('id','!=',null)
			->select(DB::raw("CONCAT(categories_code,' - ',categories_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name','id')	
			->toArray();			
		$compact['Item_category'] = $Item_categorys; 

		$Item_sizes = ['' => '']+App\Models\Item_size::where('id','!=',null)
			->select(DB::raw("CONCAT(size_code,' - ',size_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name','id')	
			->toArray();			
		$compact['Item_size'] = $Item_sizes; 

		$Item_colors = ['' => '']+App\Models\Item_color::where('id','!=',null)
			->select(DB::raw("CONCAT(color_code,' - ',color_name) AS name"), 'id')
			->orderBy('id')
			->pluck('name','id')	
			->toArray();			
		$compact['Item_color'] = $Item_colors; 

		$Item_units = ['' => '']+App\Models\Item_unit::where('id','!=',null)
			->orderBy('id')
			->pluck('unit_name','id')	
			->toArray();			
		$compact['Item_unit'] = $Item_units;

		$compact['Item_warehouse'] = $this->getItemsWarehouse($id);

		return view('items.add', $compact);
	}

	public function show($id,Request $request)
	{
		$select = _listToSelect($this->arrShowFieldView);

		$item = Item::select($select)->findOrFail($id);

		$compact['results'] = $item;
		$compact['arrShowFieldView'] = $this->arrShowFieldView;

		$Item_categorys = App\Models\Item_category::where ('id', '!=', null)
			->select(DB::raw("CONCAT(categories_code,' ',categories_name) AS name"), 'id')
			->orderBy ('id')
			->pluck ('name', 'id')
			->toArray ();		
		$compact['Item_category'] = $Item_categorys;
		
		$Item_sizes = App\Models\Item_size::where ('id', '!=', null)
			->select(DB::raw("CONCAT(size_code,' ',size_name) AS name"), 'id')
			->orderBy ('id')
			->pluck ('name', 'id')
			->toArray ();		
		$compact['Item_size'] = $Item_sizes;
		
		$Item_colors = App\Models\Item_color::where ('id', '!=', null)
			->select(DB::raw("CONCAT(color_code,' ',color_name) AS name"), 'id')
			->orderBy ('id')
			->pluck ('name', 'id')
			->toArray ();		
		$compact['Item_color'] = $Item_colors;
		
		$Item_units = App\Models\Item_unit::where ('id', '!=', null)
			->orderBy ('id')
			->pluck ('unit_name', 'id')
			->toArray ();		
		$compact['Item_unit'] = $Item_units;

		$compact['Item_warehouse'] = $this->getItemsWarehouse($id);
		
        return view('items.show', $compact);
	}

	public function update(Request $request, $id) {
		
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['updated_uid'] = Auth::id();

		$item = Item::findOrFail($id);
		
		//---- check update price
		if($input['item_sale_price'] != $item->item_sale_price){
			//$itemSalePriceHistory = Models\item_sale_price_historys;
			//$results = $itemSalePriceHistory->update($input);
		}
		//---- check update cost
		if ($input['item_cost_price'] != $item->item_cost_price) {
			//$itemCostPriceHistorys = Models\item_cost_price_historys;
			//$results = $itemCostPriceHistorys->update($input);
		}
		
		$results = $item->update($input);

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
        
        return redirect('/items');
	}

	public function store(Request $request)
	{
		$this->validator($request->all())->validate();

		DB::beginTransaction();

		$input = $request->all();
		$input['created_uid'] = Auth::id();

        $item = Item::create($input);

		$lastInsertedId = $item->id;

		if ($item) {
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

		return redirect('/items/'.$lastInsertedId.'/edit');
        //return redirect('/items');
		//return $this->update($request);
	}

	public function destroy($id) {

		DB::beginTransaction();

		$isUse = $this->chkUse($id);

		if (!$isUse) {

			$item = Item::findOrFail($id);
			$results = $item->delete();

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

	//public function genItemCode()
	public function genItemCode(Request $request ,$id=null)
	{
		
		$categoriesId = $request->input('item_categorie_id');
	
		$item_category = App\Models\Item_category::with('item_type')->findOrFail($categoriesId);

		if($id){			
			$item = Item::select('item_code')->findOrFail($id);
			return substr($item_category->item_type->type_code, 1) . "-" . substr($item_category->categories_code, 1) . "-" . substr($item->item_code, 5);
			//return $item_category->item_type->type_code . "-" . $item_category->categories_code . "-" . substr($item->item_code, 5);			
		}else{
			$item = Item::select('item_code')->get()->last();
			return substr($item_category->item_type->type_code, 1) . "-" . substr($item_category->categories_code, 1) . "-" . _genCode("", "5", substr($item->item_code, 5));
			//return $item_category->item_type->type_code . "-" . $item_category->categories_code. "-" . _genCode("", "5", substr($item->item_code, 5));
		}
	}

	private function getItemsWarehouse($id)
	{

		$results = App\Models\Warehouse_item::where('item_id', '=', $id)
		->leftJoin('warehouses', 'warehouse_items.warehouse_id', '=', 'warehouses.id')
		->get();
		if(empty($results)){
			$results = array();
		}
		//dd($results);
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
 * File Create : 2018-04-28 22:12:49 *
 */