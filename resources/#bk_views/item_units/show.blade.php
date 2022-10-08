@extends('layouts.app')
@section('title')
{{ ucfirst(__('item_unit.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-eye" aria-hidden="true"></i> {{ ucfirst(__('item_unit.head_view')) }}  </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">           
    <form action="{{ url('/posts') }}" method="POST" class="form-horizontal">        
                
        {!! (!empty( $arrShowFieldView['unit_name'] ))?
            '<div class="form-group">'.
                 Form::label('unit_name', __("item_unit.label_unit_name"), array('class' => 'col-sm-3 control-label')) 
                .'<div class="col-sm-6">'.
                     Form::text('unit_name', @$results['unit_name'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                                        
        {!! (!empty( $arrShowFieldView['unit_desc'] ))?
            '<div class="form-group">'.
                Form::label('unit_desc', __("item_unit.label_unit_desc"), array('class' => 'col-sm-3 control-label'))
            .'<div class="col-sm-6">'.              
                Form::textarea('unit_desc', @$results['unit_desc'], array('class' => 'form-control view-readonly' ,'readonly' => 'readonly'))
            .'</div>
            </div>'
        : '' !!}
                                                                                                                                                                                                                                                                        
        {!! (!empty( $arrShowFieldView['active'] ))?           
            '<div class="form-group">'.              
                Form::label('active', __("item_unit.label_active"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('active', trans( "item_unit.active_label.".$results['active'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                .'</div>
            </div>'
        : '' !!}
                            
    </form>
        <div class="ln_solid"></div>          
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!! _createButtonBack('item_units') !!}
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
 * File Create : 2018-04-28 18:18:43 *
 */
-->