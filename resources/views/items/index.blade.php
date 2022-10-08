@extends('layouts.app')
@section('title')
  {{ ucfirst(__('item.head_title')) }} 
@stop

@section('title-right')
  {!! _createButtonAdd() !!}
@stop

@section('content')

@include('items.advanced_search')

<div class="x_panel panel_hide" id="panel_list">
  <div class="x_title">
    <h2>
      {!! config('core.icon.title_list') !!}  {{ ucfirst(__('item.head_list')) }}
      <!-- <small><b>results </b>=> '' </small> --> 
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
      <div class="table table-responsive">
          <table class="table table-bordered table-striped table-hover" id="tblitem">
              <thead>
                <tr>
                    <th class='no-sort text-center'> 
                      {{ __('core.th_actions') }}
                    </th>
                    
                    @if($arrShowField['item_categorie_id']==true) 
                    <th class="text-center">
                        @sortablelink('item_categorie_id',__('item.th_item_categorie_id'))
                    </th>
                    @endif
                    
                    @if($arrShowField['item_size_id']==true) 
                    <th class="text-center">
                        @sortablelink('item_size_id',__('item.th_item_size_id'))
                    </th>
                    @endif
                    
                    @if($arrShowField['item_color_id']==true) 
                    <th class="text-center">
                        @sortablelink('item_color_id',__('item.th_item_color_id'))
                    </th>
                    @endif
                    
                    @if($arrShowField['item_unit_id']==true) 
                    <th class="text-center">
                        @sortablelink('item_unit_id',__('item.th_item_unit_id'))
                    </th>
                    @endif
                    
                    @if($arrShowField['item_code']==true) 
                    <th class="text-center">
                        @sortablelink('item_code',__('item.th_item_code'))
                    </th>
                    @endif

                    @if($arrShowField['item_name']==true) 
                    <th class="text-center">
                        @sortablelink('item_name',__('item.th_item_name'))
                    </th>
                    @endif
                    
                    @if($arrShowField['item_num']==true) 
                    <th class="text-center">
                        @sortablelink('item_num',__('item.th_item_num'))
                    </th>
                    @endif
                    
                    @if($arrShowField['item_sale_price']==true) 
                    <th class="text-center">
                        @sortablelink('item_sale_price',__('item.th_item_sale_price'))
                    </th>
                    @endif
                    
                    @if($arrShowField['item_cost_price']==true) 
                    <th class="text-center">
                        @sortablelink('item_cost_price',__('item.th_item_cost_price'))
                    </th>
                    @endif
                    
                    @if($arrShowField['item_qty']==true) 
                    <th class="text-center">
                        @sortablelink('item_qty',__('item.th_item_qty'))
                    </th>
                    @endif
                    
                    @if($arrShowField['item_qty_min']==true) 
                    <th class="text-center">
                        @sortablelink('item_qty_min',__('item.th_item_qty_min'))
                    </th>
                    @endif
                    
                    @if($arrShowField['item_qty_max']==true) 
                    <th class="text-center">
                        @sortablelink('item_qty_max',__('item.th_item_qty_max'))
                    </th>
                    @endif
                    
                    @if($arrShowField['item_sale_qty']==true) 
                    <th class="text-center">
                        @sortablelink('item_sale_qty',__('item.th_item_sale_qty'))
                    </th>
                    @endif
                    
                    @if($arrShowField['item_desc']==true) 
                    <th class="text-center">
                        @sortablelink('item_desc',__('item.th_item_desc'))
                    </th>
                    @endif
                    
                    @if($arrShowField['active']==true) 
                    <th class="text-center">
                        @sortablelink('active',__('item.th_active'))
                    </th>
                    @endif
                                    </tr>
            </thead>
            <tbody>
             @if(count($results)==0)
                <tr id="row-bank">
                    <td class="text-center" colspan="200"> {{ ucfirst(__('core.no records')) }} </td>
                </tr>
            @endif
            @foreach($results as $item)
                <tr id="row-item-id-{{$item->id}}">
                    <td class="text-center">
                    {!! _createActionsButtonList($item->id) !!}
                    </td>
                    {!! (!empty( $arrShowField['item_categorie_id'] ))?  '<td>'. $Item_category[$item->item_categorie_id] .'</td>' : ""   !!}
                    {!! (!empty( $arrShowField['item_size_id'] ))?  '<td>'. $Item_size[$item->item_size_id] .'</td>' : ""   !!}
                    {!! (!empty( $arrShowField['item_color_id'] ))?  '<td>'. $Item_color[$item->item_color_id] .'</td>' : ""   !!}
                    {!! (!empty( $arrShowField['item_unit_id'] ))?  '<td>'. $Item_unit[$item->item_unit_id] .'</td>' : ""   !!}
                    {!! (!empty( $arrShowField['item_code'] ))?  '<td>'. $item->item_code .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['item_name'] ))?  '<td>'. $item->item_name .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['item_num'] ))?  '<td>'. $item->item_num .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['item_sale_price'] ))?   '<td>'.  $item->item_sale_price .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['item_cost_price'] ))?   '<td>'.  $item->item_cost_price .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['item_qty'] ))?   '<td>'.  $item->item_qty .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['item_qty_min'] ))?   '<td>'.  $item->item_qty_min .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['item_qty_max'] ))?   '<td>'.  $item->item_qty_max .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['item_sale_qty'] ))?   '<td>'.  $item->item_sale_qty .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['item_desc'] ))? '<td>'. str_limit( $item->item_desc,config('core.textarea_limit'),config('core.textarea_end_str')).'</td>': ""   !!}
                    {!! (!empty( $arrShowField['active'] ))? '<td class="text-center">'. _createTypeRadio( 'active', $item->id , $item->active ) .'</td>': ""   !!}
                </tr>
              @endforeach
              </tbody>
          </table>
      </div>
      @include('partials._panel_pagination')
  </div>
  <div class="clearfix"></div>
  <!--/.x_content -->
</div>
<!--/.x_panel -->
{!! Form::open(['id' => 'form']) !!}     
{!! Form::close() !!}
@endsection



<!--
/** 
 * CRUD Laravel
 * Master ฺBY Kepex  =>  https://github.com/kEpEx/laravel-crud-generator
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 06/04/2018 13:51
 * Version : ver.1.00.00
 *
 * File Create : 2018-04-28 22:12:49 *
 */
-->
