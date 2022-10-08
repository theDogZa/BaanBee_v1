@extends('layouts.app')
@section('title')
  {{ ucfirst(__('user.head_title')) }} 
@stop

@section('title-right')
  {!! _createButtonAdd() !!}
@stop

@section('content')

@include('users.advanced_search')

<div class="x_panel panel_hide" id="panel_list">
  <div class="x_title">
    <h2>
      {!! config('core.icon.title_list') !!}  {{ ucfirst(__('user.head_list')) }}
      <!-- <small><b>results </b>=> '' </small> --> 
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
      <div class="table table-responsive">
          <table class="table table-bordered table-striped table-hover" id="tbluser">
              <thead>
                <tr>
                    <th class='no-sort text-center'> 
                      {{ __('core.th_actions') }}
                    </th>
                    
                    @if($arrShowField['name']==true) 
                    <th class="text-center">
                        @sortablelink('name',__('user.th_name'))
                    </th>
                    @endif
                    
                    @if($arrShowField['username']==true) 
                    <th class="text-center">
                        @sortablelink('username',__('user.th_username'))
                    </th>
                    @endif
                    
                    @if($arrShowField['email']==true) 
                    <th class="text-center">
                        @sortablelink('email',__('user.th_email'))
                    </th>
                    @endif
                    
                    @if($arrShowField['password']==true) 
                    <th class="text-center">
                        @sortablelink('password',__('user.th_password'))
                    </th>
                    @endif
                    
                    @if($arrShowField['remember_token']==true) 
                    <th class="text-center">
                        @sortablelink('remember_token',__('user.th_remember_token'))
                    </th>
                    @endif
                    
                    @if($arrShowField['online']==true) 
                    <th class="text-center">
                        @sortablelink('online',__('user.th_online'))
                    </th>
                    @endif
                    
                    @if($arrShowField['active']==true) 
                    <th class="text-center">
                        @sortablelink('active',__('user.th_active'))
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
                    {!! (!empty( $arrShowField['name'] ))?  '<td>'. $item->name .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['username'] ))?  '<td>'. $item->username .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['email'] ))?  '<td>'. $item->email .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['password'] ))?  '<td>'. $item->password .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['remember_token'] ))?  '<td>'. $item->remember_token .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['online'] ))?  '<td class="text-center">'. _createTypeRadio( 'online', $item->id , $item->online ) .'</td>': ""   !!}
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
 * File Create : 2018-04-15 00:04:43 *
 */
-->
