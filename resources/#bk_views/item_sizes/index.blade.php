@extends('layouts.app')
@section('title')
  {{ ucfirst(__('item_size.head_title')) }} 
@stop

@section('title-right')
  {!! _createButtonAdd() !!}
@stop

@section('content')

@include('item_sizes.advanced_search')

<div class="x_panel panel_hide" id="panel_list">
  <div class="x_title">
    <h2>
      {!! config('core.icon.title_list') !!}  {{ ucfirst(__('item_size.head_list')) }}
      <!-- <small><b>results </b>=> '' </small> --> 
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
      <div class="table table-responsive">
          <table class="table table-bordered table-striped table-hover" id="tblitem_size">
              <thead>
                <tr>
                    <th class='no-sort text-center'> 
                      {{ __('core.th_actions') }}
                    </th>
                    
                    @if($arrShowField['size_name']==true) 
                    <th class="text-center">
                        @sortablelink('size_name',__('item_size.th_size_name'))
                    </th>
                    @endif
                    
                    @if($arrShowField['size_code']==true) 
                    <th class="text-center">
                        @sortablelink('size_code',__('item_size.th_size_code'))
                    </th>
                    @endif
                    
                    @if($arrShowField['size_desc']==true) 
                    <th class="text-center">
                        @sortablelink('size_desc',__('item_size.th_size_desc'))
                    </th>
                    @endif
                    
                    @if($arrShowField['active']==true) 
                    <th class="text-center">
                        @sortablelink('active',__('item_size.th_active'))
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
                    {!! (!empty( $arrShowField['size_name'] ))?  '<td>'. $item->size_name .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['size_code'] ))?  '<td>'. $item->size_code .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['size_desc'] ))? '<td>'. str_limit( $item->size_desc,config('core.textarea_limit'),config('core.textarea_end_str')).'</td>': ""   !!}
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
 * Master ???BY Kepex  =>  https://github.com/kEpEx/laravel-crud-generator
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 06/04/2018 13:51
 * Version : ver.1.00.00
 *
 * File Create : 2018-04-28 18:18:50 *
 */
-->
