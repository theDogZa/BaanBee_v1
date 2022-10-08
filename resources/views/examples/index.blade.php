@extends('layouts.app')
@section('title')
  {{ ucfirst(__('example.head_title')) }} 
@stop

@section('title-right')
  {!! _createButtonAdd() !!}
@stop

@section('content')

@include('examples.advanced_search')

<div class="x_panel panel_hide" id="panel_list">
  <div class="x_title">
    <h2>
      {!! config('core.icon.title_list') !!}  {{ ucfirst(__('example.head_list')) }}
      <!-- <small><b>results </b>=> '' </small> --> 
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
      <div class="table table-responsive">
          <table class="table table-bordered table-striped table-hover" id="tblexample">
              <thead>
                <tr>
                    <th class='no-sort text-center'> 
                      {{ __('core.th_actions') }}
                    </th>
                    
                    @if($arrShowField['parent_id']==true) 
                    <th class="text-center">
                        @sortablelink('parent_id',__('example.th_parent_id'))
                    </th>
                    @endif
                    
                    @if($arrShowField['users_id']==true) 
                    <th class="text-center">
                        @sortablelink('users_id',__('example.th_users_id'))
                    </th>
                    @endif
                    
                    @if($arrShowField['title']==true) 
                    <th class="text-center">
                        @sortablelink('title',__('example.th_title'))
                    </th>
                    @endif
                    
                    @if($arrShowField['body']==true) 
                    <th class="text-center">
                        @sortablelink('body',__('example.th_body'))
                    </th>
                    @endif
                    
                    @if($arrShowField['amount']==true) 
                    <th class="text-center">
                        @sortablelink('amount',__('example.th_amount'))
                    </th>
                    @endif
                    
                    @if($arrShowField['date']==true) 
                    <th class="text-center">
                        @sortablelink('date',__('example.th_date'))
                    </th>
                    @endif
                    
                    @if($arrShowField['time']==true) 
                    <th class="text-center">
                        @sortablelink('time',__('example.th_time'))
                    </th>
                    @endif
                    
                    @if($arrShowField['datetime']==true) 
                    <th class="text-center">
                        @sortablelink('datetime',__('example.th_datetime'))
                    </th>
                    @endif
                    
                    @if($arrShowField['status']==true) 
                    <th class="text-center">
                        @sortablelink('status',__('example.th_status'))
                    </th>
                    @endif
                    
                    @if($arrShowField['active']==true) 
                    <th class="text-center">
                        @sortablelink('active',__('example.th_active'))
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
                    {!! (!empty( $arrShowField['parent_id'] ))?  '<td>'. $Example[$item->parent_id] .'</td>' : ""   !!}
                    {!! (!empty( $arrShowField['users_id'] ))?  '<td>'. $Userss[$item->users_id] .'</td>' : ""   !!}
                    {!! (!empty( $arrShowField['title'] ))?  '<td>'. $item->title .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['body'] ))? '<td>'. str_limit( $item->body,config('core.textarea_limit'),config('core.textarea_end_str')).'</td>': ""   !!}
                    {!! (!empty( $arrShowField['amount'] ))?   '<td>'.  $item->amount .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['date'] ))?  '<td>'.  _datetime($item->date,2) .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['time'] ))?  '<td>'. _datetime($item->time,3) .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['datetime'] ))?  '<td>'. _datetime($item->datetime,1) .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['status'] ))?  '<td class="text-center">'. _createTypeRadio( 'status', $item->id , $item->status ) .'</td>': ""   !!}
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
 * File Create : 2019-11-29 18:09:18 *
 */
-->
