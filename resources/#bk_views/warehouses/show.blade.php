@extends('layouts.app')
@section('title')
{{ ucfirst(__('warehouse.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-eye" aria-hidden="true"></i> {{ ucfirst(__('warehouse.head_view')) }}  </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">           
    <form action="{{ url('/posts') }}" method="POST" class="form-horizontal">        
                
        {!! (!empty( $arrShowFieldView['warehouse_name'] ))?
            '<div class="form-group">'.
                 Form::label('warehouse_name', __("warehouse.label_warehouse_name"), array('class' => 'col-sm-3 control-label')) 
                .'<div class="col-sm-6">'.
                     Form::text('warehouse_name', @$results['warehouse_name'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                
        {!! (!empty( $arrShowFieldView['warehouse_code'] ))?
            '<div class="form-group">'.
                 Form::label('warehouse_code', __("warehouse.label_warehouse_code"), array('class' => 'col-sm-3 control-label')) 
                .'<div class="col-sm-6">'.
                     Form::text('warehouse_code', @$results['warehouse_code'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                                        
        {!! (!empty( $arrShowFieldView['warehouse_address'] ))?
            '<div class="form-group">'.
                Form::label('warehouse_address', __("warehouse.label_warehouse_address"), array('class' => 'col-sm-3 control-label'))
            .'<div class="col-sm-6">'.              
                Form::textarea('warehouse_address', @$results['warehouse_address'], array('class' => 'form-control view-readonly' ,'readonly' => 'readonly'))
            .'</div>
            </div>'
        : '' !!}
                                                        
        {!! (!empty( $arrShowFieldView['province_id'] ))?
            '<div class="form-group">'.              
                Form::label('province_id', __("warehouse.label_province_id"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('province_id',  @$Province[@$results['province_id']]  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                .'</div>
            </div>'
        : '' !!}
                        
        {!! (!empty( $arrShowFieldView['warehouse_tel1'] ))?
            '<div class="form-group">'.
                 Form::label('warehouse_tel1', __("warehouse.label_warehouse_tel1"), array('class' => 'col-sm-3 control-label')) 
                .'<div class="col-sm-6">'.
                     Form::text('warehouse_tel1', @$results['warehouse_tel1'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                
        {!! (!empty( $arrShowFieldView['warehouse_tel2'] ))?
            '<div class="form-group">'.
                 Form::label('warehouse_tel2', __("warehouse.label_warehouse_tel2"), array('class' => 'col-sm-3 control-label')) 
                .'<div class="col-sm-6">'.
                     Form::text('warehouse_tel2', @$results['warehouse_tel2'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                                        
        {!! (!empty( $arrShowFieldView['warehouse_desc'] ))?
            '<div class="form-group">'.
                Form::label('warehouse_desc', __("warehouse.label_warehouse_desc"), array('class' => 'col-sm-3 control-label'))
            .'<div class="col-sm-6">'.              
                Form::textarea('warehouse_desc', @$results['warehouse_desc'], array('class' => 'form-control view-readonly' ,'readonly' => 'readonly'))
            .'</div>
            </div>'
        : '' !!}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
        {!! (!empty( $arrShowFieldView['active'] ))?           
            '<div class="form-group">'.              
                Form::label('active', __("warehouse.label_active"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('active', trans( "warehouse.active_label.".$results['active'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                .'</div>
            </div>'
        : '' !!}
                            
    </form>
        <div class="ln_solid"></div>          
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!! _createButtonBack('warehouses') !!}
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
 * File Create : 2018-05-15 22:39:53 *
 */
-->