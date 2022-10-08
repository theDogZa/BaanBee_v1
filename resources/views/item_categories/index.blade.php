@extends('layouts.app')
@section('title')
  {{ ucfirst(__('item_category.head_title')) }} 
@stop

@section('title-right')
  {!! _createButtonAdd() !!}
@stop

@section('content')

@include('item_categories.advanced_search')

<div class="x_panel panel_hide" id="panel_list">
  <div class="x_title">
    <h2>
      {!! config('core.icon.title_list') !!}  {{ ucfirst(__('item_category.head_list')) }}
      <!-- <small><b>results </b>=> '' </small> --> 
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
      <div class="table table-responsive">
          <table class="table table-bordered table-striped table-hover" id="tblitem_category">
              <thead>
                <tr>
                    <th class='no-sort text-center'> 
                      {{ __('core.th_actions') }}
                    </th>
                    
                    @if($arrShowField['item_type_id']==true) 
                    <th class="text-center">
                        @sortablelink('item_type_id',__('item_category.th_item_type_id'))
                    </th>
                    @endif
                    
                    @if($arrShowField['categories_name']==true) 
                    <th class="text-center">
                        @sortablelink('categories_name',__('item_category.th_categories_name'))
                    </th>
                    @endif
                    
                    @if($arrShowField['categories_code']==true) 
                    <th class="text-center">
                        @sortablelink('categories_code',__('item_category.th_categories_code'))
                    </th>
                    @endif
                    
                    @if($arrShowField['categories_desc']==true) 
                    <th class="text-center">
                        @sortablelink('categories_desc',__('item_category.th_categories_desc'))
                    </th>
                    @endif
                    
                    @if($arrShowField['active']==true) 
                    <th class="text-center">
                        @sortablelink('active',__('item_category.th_active'))
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
                    {!! (!empty( $arrShowField['item_type_id'] ))?  '<td>'. $Item_type[$item->item_type_id] .'</td>' : ""   !!}
                    {!! (!empty( $arrShowField['categories_name'] ))?  '<td>'. $item->categories_name .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['categories_code'] ))?  '<td>'. $item->categories_code .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['categories_desc'] ))? '<td>'. str_limit( $item->categories_desc,config('core.textarea_limit'),config('core.textarea_end_str')).'</td>': ""   !!}
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
 * File Create : 2018-04-28 17:51:42 *
 */
-->
