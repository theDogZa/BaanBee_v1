@extends('layouts.app')
@section('title')
  {{ ucfirst(__('warehouse.head_title')) }} 
@stop

@section('title-right')
  {!! _createButtonAdd() !!}
@stop

@section('content')

@include('warehouses.advanced_search')

<div class="x_panel panel_hide" id="panel_list">
  <div class="x_title">
    <h2>
      {!! config('core.icon.title_list') !!}  {{ ucfirst(__('warehouse.head_list')) }}
      <!-- <small><b>results </b>=> '' </small> --> 
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
      <div class="table table-responsive">
          <table class="table table-bordered table-striped table-hover" id="tblwarehouse">
              <thead>
                <tr>
                    <th class='no-sort text-center'> 
                      {{ __('core.th_actions') }}
                    </th>
                    
                    @if($arrShowField['warehouse_name']==true) 
                    <th class="text-center">
                        @sortablelink('warehouse_name',__('warehouse.th_warehouse_name'))
                    </th>
                    @endif
                    
                    @if($arrShowField['warehouse_code']==true) 
                    <th class="text-center">
                        @sortablelink('warehouse_code',__('warehouse.th_warehouse_code'))
                    </th>
                    @endif
                    
                    @if($arrShowField['warehouse_address']==true) 
                    <th class="text-center">
                        @sortablelink('warehouse_address',__('warehouse.th_warehouse_address'))
                    </th>
                    @endif
                    
                    @if($arrShowField['province_id']==true) 
                    <th class="text-center">
                        @sortablelink('province_id',__('warehouse.th_province_id'))
                    </th>
                    @endif
                    
                    @if($arrShowField['warehouse_tel1']==true) 
                    <th class="text-center">
                        @sortablelink('warehouse_tel1',__('warehouse.th_warehouse_tel1'))
                    </th>
                    @endif
                    
                    @if($arrShowField['warehouse_tel2']==true) 
                    <th class="text-center">
                        @sortablelink('warehouse_tel2',__('warehouse.th_warehouse_tel2'))
                    </th>
                    @endif
                    
                    @if($arrShowField['warehouse_desc']==true) 
                    <th class="text-center">
                        @sortablelink('warehouse_desc',__('warehouse.th_warehouse_desc'))
                    </th>
                    @endif
                    
                    @if($arrShowField['active']==true) 
                    <th class="text-center">
                        @sortablelink('active',__('warehouse.th_active'))
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
                    {!! (!empty( $arrShowField['warehouse_name'] ))?  '<td>'. $item->warehouse_name .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['warehouse_code'] ))?  '<td>'. $item->warehouse_code .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['warehouse_address'] ))? '<td>'. str_limit( $item->warehouse_address,config('core.textarea_limit'),config('core.textarea_end_str')).'</td>': ""   !!}
                    {!! (!empty( $arrShowField['province_id'] ))?  '<td>'. $Province[$item->province_id] .'</td>' : ""   !!}
                    {!! (!empty( $arrShowField['warehouse_tel1'] ))?  '<td>'. $item->warehouse_tel1 .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['warehouse_tel2'] ))?  '<td>'. $item->warehouse_tel2 .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['warehouse_desc'] ))? '<td>'. str_limit( $item->warehouse_desc,config('core.textarea_limit'),config('core.textarea_end_str')).'</td>': ""   !!}
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
 * File Create : 2018-05-15 22:39:53 *
 */
-->
