@extends('layouts.app')
@section('title')
{{ ucfirst(__('auth_menu.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-eye" aria-hidden="true"></i> {{ ucfirst(__('auth_menu.head_view')) }}  </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">           
    <form action="{{ url('/posts') }}" method="POST" class="form-horizontal">        
                        
        {!! (!empty( $arrShowFieldView['groups'] ))?
            '<div class="form-group">'.
                 Form::label('groups', __("auth_menu.label_groups"), array('class' => 'col-sm-3 control-label')) 
                 .'<div class="col-sm-6">'.
                     Form::number('groups',@$results['groups'], array('class' => 'form-control view-readonly','readonly' => 'readonly')) 
                .'</div>
            </div>'
        : '' !!}
                                                                
        {!! (!empty( $arrShowFieldView['parent_id'] ))?
            '<div class="form-group">'.              
                Form::label('parent_id', __("auth_menu.label_parent_id"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('parent_id',  @$Auth_menu[@$results['parent_id']]  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                .'</div>
            </div>'
        : '' !!}
                        
        {!! (!empty( $arrShowFieldView['menu_name'] ))?
            '<div class="form-group">'.
                 Form::label('menu_name', __("auth_menu.label_menu_name"), array('class' => 'col-sm-3 control-label')) 
                .'<div class="col-sm-6">'.
                     Form::text('menu_name', @$results['menu_name'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                
        {!! (!empty( $arrShowFieldView['menu_link'] ))?
            '<div class="form-group">'.
                 Form::label('menu_link', __("auth_menu.label_menu_link"), array('class' => 'col-sm-3 control-label')) 
                .'<div class="col-sm-6">'.
                     Form::text('menu_link', @$results['menu_link'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                
        {!! (!empty( $arrShowFieldView['menu_icon'] ))?
            '<div class="form-group">'.
                 Form::label('menu_icon', __("auth_menu.label_menu_icon"), array('class' => 'col-sm-3 control-label')) 
                .'<div class="col-sm-6">'.
                     Form::text('menu_icon', @$results['menu_icon'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                        
        {!! (!empty( $arrShowFieldView['menu_sort'] ))?
            '<div class="form-group">'.
                 Form::label('menu_sort', __("auth_menu.label_menu_sort"), array('class' => 'col-sm-3 control-label')) 
                 .'<div class="col-sm-6">'.
                     Form::number('menu_sort',@$results['menu_sort'], array('class' => 'form-control view-readonly','readonly' => 'readonly')) 
                .'</div>
            </div>'
        : '' !!}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
        {!! (!empty( $arrShowFieldView['active'] ))?           
            '<div class="form-group">'.              
                Form::label('active', __("auth_menu.label_active"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('active', trans( "auth_menu.active_label.".$results['active'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                .'</div>
            </div>'
        : '' !!}
                            
    </form>
        <div class="ln_solid"></div>          
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!! _createButtonBack('auth_menuses') !!}
            </div>
        </div>  
        </div>
        <!--/.x_content -->
      </div>
      <!--/.x_panel -->
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