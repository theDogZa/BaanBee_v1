@extends('layouts.app')
@section('title')
{{ ucfirst(__('user.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-eye" aria-hidden="true"></i> {{ ucfirst(__('user.head_view')) }}  </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">           
    <form action="{{ url('/posts') }}" method="POST" class="form-horizontal">        
                
        {!! (!empty( $arrShowFieldView['name'] ))?
            '<div class="form-group">'.
                 Form::label('name', __("user.label_name"), array('class' => 'col-sm-3 control-label')) 
                .'<div class="col-sm-6">'.
                     Form::text('name', @$results['name'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                
        {!! (!empty( $arrShowFieldView['username'] ))?
            '<div class="form-group">'.
                 Form::label('username', __("user.label_username"), array('class' => 'col-sm-3 control-label')) 
                .'<div class="col-sm-6">'.
                     Form::text('username', @$results['username'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                
        {!! (!empty( $arrShowFieldView['email'] ))?
            '<div class="form-group">'.
                 Form::label('email', __("user.label_email"), array('class' => 'col-sm-3 control-label')) 
                .'<div class="col-sm-6">'.
                     Form::text('email', @$results['email'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                
        {!! (!empty( $arrShowFieldView['password'] ))?
            '<div class="form-group">'.
                 Form::label('password', __("user.label_password"), array('class' => 'col-sm-3 control-label')) 
                .'<div class="col-sm-6">'.
                     Form::text('password', @$results['password'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                
        {!! (!empty( $arrShowFieldView['remember_token'] ))?
            '<div class="form-group">'.
                 Form::label('remember_token', __("user.label_remember_token"), array('class' => 'col-sm-3 control-label')) 
                .'<div class="col-sm-6">'.
                     Form::text('remember_token', @$results['remember_token'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                                                                                                                                                                                                                                                                                                                                                
        {!! (!empty( $arrShowFieldView['online'] ))?
            '<div class="form-group">'.              
                Form::label('online', __("user.label_online"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('online', trans( "user.online_label.".$results['online'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                .'</div>
            </div>'
        : '' !!}
                                                                                                                                                                                                                                
        {!! (!empty( $arrShowFieldView['active'] ))?           
            '<div class="form-group">'.              
                Form::label('active', __("user.label_active"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('active', trans( "user.active_label.".$results['active'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                .'</div>
            </div>'
        : '' !!}
                            
    </form>
        <div class="ln_solid"></div>          
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!! _createButtonBack('users') !!}
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
 * File Create : 2018-04-15 00:04:43 *
 */
-->