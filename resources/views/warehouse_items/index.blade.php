@extends('layouts.app')
@section('title')
  {{ ucfirst(__('warehouse_item.head_title')) }} 
@stop

@section('title-right')
  {!! _createButtonAdd() !!}
@stop

@section('content')

@include('warehouse_items.advanced_search')

<div class="x_panel panel_hide" id="panel_list">
  <div class="x_title">
    <h2>
      {!! config('core.icon.title_list') !!}  {{ ucfirst(__('warehouse_item.head_list')) }}
      <!-- <small><b>results </b>=> '' </small> --> 
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
      <div class="table table-responsive">
          <table class="table table-bordered table-striped table-hover" id="tblwarehouse_item">
              <thead>
                <tr>
                    <th class='no-sort text-center'> 
                      {{ __('core.th_actions') }}
                    </th>
                    
                    @if($arrShowField['warehouse_id']==true) 
                    <th class="text-center">
                        @sortablelink('warehouse_id',__('warehouse_item.th_warehouse_id'))
                    </th>
                    @endif
                    
                    @if($arrShowField['item_id']==true) 
                    <th class="text-center">
                        @sortablelink('item_id',__('warehouse_item.th_item_id'))
                    </th>
                    @endif
                    
                    @if($arrShowField['qty']==true) 
                    <th class="text-center">
                        @sortablelink('qty',__('warehouse_item.th_qty'))
                    </th>
                    @endif
                    
                    @if($arrShowField['min_qty']==true) 
                    <th class="text-center">
                        @sortablelink('min_qty',__('warehouse_item.th_min_qty'))
                    </th>
                    @endif
                    
                    @if($arrShowField['max_qty']==true) 
                    <th class="text-center">
                        @sortablelink('max_qty',__('warehouse_item.th_max_qty'))
                    </th>
                    @endif
                    
                    @if($arrShowField['warehouse_item_desc']==true) 
                    <th class="text-center">
                        @sortablelink('warehouse_item_desc',__('warehouse_item.th_warehouse_item_desc'))
                    </th>
                    @endif
                    
                    @if($arrShowField['active']==true) 
                    <th class="text-center">
                        @sortablelink('active',__('warehouse_item.th_active'))
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
                    {!! (!empty( $arrShowField['warehouse_id'] ))?  '<td>'. $Warehouse[$item->warehouse_id] .'</td>' : ""   !!}
                    {!! (!empty( $arrShowField['item_id'] ))?  '<td>'. $Item[$item->item_id] .'</td>' : ""   !!}
                    {!! (!empty( $arrShowField['qty'] ))?   '<td>'.  $item->qty .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['min_qty'] ))?   '<td>'.  $item->min_qty .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['max_qty'] ))?   '<td>'.  $item->max_qty .'</td>': ""   !!}
                     {!! (!empty( $arrShowField['warehouse_item_desc'] ))? '<td>'. str_limit( $item->warehouse_item_desc,config('core.textarea_limit'),config('core.textarea_end_str')).'</td>': ""   !!}
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
 * File Create : 2018-05-15 22:59:05 *
 */
-->
