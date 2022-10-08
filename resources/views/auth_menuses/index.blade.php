@extends('layouts.app')
@section('title')
  {{ ucfirst(__('auth_menu.head_title')) }} 
@stop

@section('title-right')
  {!! _createButtonAdd() !!}
@stop

@section('content')

@include('auth_menuses.advanced_search')

<div class="x_panel panel_hide" id="panel_list">
  <div class="x_title">
    <h2>
      {!! config('core.icon.title_list') !!}  {{ ucfirst(__('auth_menu.head_list')) }}
      <!-- <small><b>results </b>=> '' </small> --> 
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
      <div class="table table-responsive">
          <table class="table table-bordered table-striped table-hover" id="tblauth_menu">
              <thead>
                <tr>
                    <th class='no-sort text-center'> 
                      {{ __('core.th_actions') }}
                    </th>
                    
                    @if($arrShowField['groups']==true) 
                    <th class="text-center">
                        @sortablelink('groups',__('auth_menu.th_groups'))
                    </th>
                    @endif
                    
                    @if($arrShowField['parent_id']==true) 
                    <th class="text-center">
                        @sortablelink('parent_id',__('auth_menu.th_parent_id'))
                    </th>
                    @endif
                    
                    @if($arrShowField['menu_name']==true) 
                    <th class="text-center">
                        @sortablelink('menu_name',__('auth_menu.th_menu_name'))
                    </th>
                    @endif
                    
                    @if($arrShowField['menu_link']==true) 
                    <th class="text-center">
                        @sortablelink('menu_link',__('auth_menu.th_menu_link'))
                    </th>
                    @endif
                    
                    @if($arrShowField['menu_icon']==true) 
                    <th class="text-center">
                        @sortablelink('menu_icon',__('auth_menu.th_menu_icon'))
                    </th>
                    @endif
                    
                    @if($arrShowField['menu_sort']==true) 
                    <th class="text-center">
                        @sortablelink('menu_sort',__('auth_menu.th_menu_sort'))
                    </th>
                    @endif
                    
                    @if($arrShowField['active']==true) 
                    <th class="text-center">
                        @sortablelink('active',__('auth_menu.th_active'))
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
                    {!! (!empty( $arrShowField['parent_id'] ))?  '<td>'. $Auth_menu[$item->parent_id] .'</td>' : ""   !!}
                    {!! (!empty( $arrShowField['menu_name'] ))?  '<td>'. $item->menu_name .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['menu_link'] ))?  '<td>'. $item->menu_link .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['menu_icon'] ))?  '<td>'. $item->menu_icon .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['groups'] ))?   '<td>'.  $item->groups .'</td>': ""   !!}
                    {!! (!empty( $arrShowField['menu_sort'] ))?   '<td>'.  $item->menu_sort .'</td>': ""   !!}
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
 * File Create : 2018-04-17 22:48:07 *
 */
-->
