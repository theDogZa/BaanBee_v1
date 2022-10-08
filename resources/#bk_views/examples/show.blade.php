@extends('layouts.app')
@section('title')
{{ ucfirst(__('example.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-eye" aria-hidden="true"></i> {{ ucfirst(__('example.head_view')) }}  </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">           
    <form action="{{ url('/posts') }}" method="POST" class="form-horizontal">        
                                        
        {!! (!empty( $arrShowFieldView['parent_id'] ))?
            '<div class="form-group">'.              
                Form::label('parent_id', __("example.label_parent_id"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('parent_id',  @$Example[@$results['parent_id']]  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                .'</div>
            </div>'
        : '' !!}
                                                
        {!! (!empty( $arrShowFieldView['users_id'] ))?
            '<div class="form-group">'.              
                Form::label('users_id', __("example.label_users_id"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('users_id',  @$User[@$results['users_id']]  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                .'</div>
            </div>'
        : '' !!}
                        
        {!! (!empty( $arrShowFieldView['title'] ))?
            '<div class="form-group">'.
                 Form::label('title', __("example.label_title"), array('class' => 'col-sm-3 control-label')) 
                .'<div class="col-sm-6">'.
                     Form::text('title', @$results['title'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                                        
        {!! (!empty( $arrShowFieldView['body'] ))?
            '<div class="form-group">'.
                Form::label('body', __("example.label_body"), array('class' => 'col-sm-3 control-label'))
            .'<div class="col-sm-6">'.              
                Form::textarea('body', @$results['body'], array('class' => 'form-control view-readonly' ,'readonly' => 'readonly'))
            .'</div>
            </div>'
        : '' !!}
                                        
        {!! (!empty( $arrShowFieldView['amount'] ))?
            '<div class="form-group">'.
                 Form::label('amount', __("example.label_amount"), array('class' => 'col-sm-3 control-label')) 
                 .'<div class="col-sm-6">'.
                     Form::number('amount',@$results['amount'], array('class' => 'form-control view-readonly','readonly' => 'readonly')) 
                .'</div>
            </div>'
        : '' !!}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
        {!! (!empty( $arrShowFieldView['date'] ))?
            '<div class="form-group">'.              
                Form::label('date', __("example.label_date"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('date', _datetime(@$results['date'],2)  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                .'</div>
            </div>'
        : '' !!}
                                                        
        {!! (!empty( $arrShowFieldView['time'] ))?  
            '<div class="form-group">'.              
                Form::label('time', __("example.label_time"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('time', _datetime(@$results['time'],3)  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                .'</div>
            </div>'
        : '' !!}
                                        
        {!! (!empty( $arrShowFieldView['datetime'] ))?
            '<div class="form-group">'.              
                Form::label('datetime', __("example.label_datetime"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('datetime', _datetime(@$results['datetime'],1)  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                .'</div>
            </div>'
        : '' !!}
                                                                                
        {!! (!empty( $arrShowFieldView['status'] ))?
            '<div class="form-group">'.              
                Form::label('status', __("example.label_status"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('status', trans( "example.status_label.".$results['status'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                .'</div>
            </div>'
        : '' !!}
                                                                                                                                                                                                                                                                                                        
        {!! (!empty( $arrShowFieldView['active'] ))?           
            '<div class="form-group">'.              
                Form::label('active', __("example.label_active"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('active', trans( "example.active_label.".$results['active'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                .'</div>
            </div>'
        : '' !!}
                            
    </form>
        <div class="ln_solid"></div>          
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!! _createButtonBack('examples') !!}
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
 * File Create : 2018-04-14 01:57:15 *
 */
-->