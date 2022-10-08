@extends('layouts.app')
@section('title')
  {{ ucfirst(__('item_adjusted_type.head_title')) }} 
@stop

@section('title-right')
  {!! _createButtonAdd() !!}
@stop

@section('content')

@include('item_adjusted_types.advanced_search')

<div class="x_panel panel_hide" id="panel_list">
  <div class="x_title">
    <h2>
      {!! config('core.icon.title_list') !!}  {{ ucfirst(__('item_adjusted_type.head_list')) }}
      <!-- <small><b>results </b>=> '' </small> --> 
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
      <div class="table table-responsive">
          <table class="table table-bordered table-striped table-hover" id="tblitem_adjusted_type">
              <thead>
                <tr>
                    <th class='no-sort text-center'> 
                      {{ __('core.th_actions') }}
                    </th>
                    
                    @if($arrShowField['adjusted_type_codes']==true) 
                    <th class="text-center">
                        @sortablelink('adjusted_type_codes',__('item_adjusted_type.th_adjusted_type_codes'))
                    </th>
                    @endif
                    
                    @if($arrShowField['adjusted_type_name_th']==true) 
                    <th class="text-center">
                        @sortablelink('adjusted_type_name_th',__('item_adjusted_type.th_adjusted_type_name_th'))
                    </th>
                    @endif
                    
                    @if($arrShowField['adjusted_type_name_en']==true) 
                    <th class="text-center">
                        @sortablelink('adjusted_type_name_en',__('item_adjusted_type.th_adjusted_type_name_en'))
                    </th>
                    @endif
                    
                    @if($arrShowField['adjusted_type_desc']==true) 
                    <th class="text-center">
                        @sortablelink('adjusted_type_desc',__('item_adjusted_type.th_adjusted_type_desc'))
                    </th>
                    @endif
                    
                    @if($arrShowField['active']==true) 
                    <th class="text-center">
                        @sortablelink('active',__('item_adjusted_type.th_active'))
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
                    {!! (!empty( $arrShowField['adjusted_type_codes'] ))?  '<td>'. $item->adjusted_type_codes .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['adjusted_type_name_th'] ))?  '<td>'. $item->adjusted_type_name_th .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['adjusted_type_name_en'] ))?  '<td>'. $item->adjusted_type_name_en .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['adjusted_type_desc'] ))? '<td>'. str_limit( $item->adjusted_type_desc,config('core.textarea_limit'),config('core.textarea_end_str')).'</td>': ""   !!}
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
 * File Create : 2018-07-25 22:06:10 *
 */
-->
