@extends('layouts.app')
@section('title')
{{ ucfirst(__('warehouse_item.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-eye" aria-hidden="true"></i> {{ ucfirst(__('warehouse_item.head_view')) }}  </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">           
    <form action="{{ url('/posts') }}" method="POST" class="form-horizontal">        
                                        
        {!! (!empty( $arrShowFieldView['warehouse_id'] ))?
            '<div class="form-group">'.              
                Form::label('warehouse_id', __("warehouse_item.label_warehouse_id"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('warehouse_id',  @$Warehouse[@$results['warehouse_id']]  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                .'</div>
            </div>'
        : '' !!}
                                                
        {!! (!empty( $arrShowFieldView['item_id'] ))?
            '<div class="form-group">'.              
                Form::label('item_id', __("warehouse_item.label_item_id"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('item_id',  @$Item[@$results['item_id']]  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                .'</div>
            </div>'
        : '' !!}
                                
        {!! (!empty( $arrShowFieldView['qty'] ))?
            '<div class="form-group">'.
                 Form::label('qty', __("warehouse_item.label_qty"), array('class' => 'col-sm-3 control-label')) 
                 .'<div class="col-sm-6">'.
                     Form::number('qty',@$results['qty'], array('class' => 'form-control view-readonly','readonly' => 'readonly')) 
                .'</div>
            </div>'
        : '' !!}
                                                
        {!! (!empty( $arrShowFieldView['min_qty'] ))?
            '<div class="form-group">'.
                 Form::label('min_qty', __("warehouse_item.label_min_qty"), array('class' => 'col-sm-3 control-label')) 
                 .'<div class="col-sm-6">'.
                     Form::number('min_qty',@$results['min_qty'], array('class' => 'form-control view-readonly','readonly' => 'readonly')) 
                .'</div>
            </div>'
        : '' !!}
                                                
        {!! (!empty( $arrShowFieldView['max_qty'] ))?
            '<div class="form-group">'.
                 Form::label('max_qty', __("warehouse_item.label_max_qty"), array('class' => 'col-sm-3 control-label')) 
                 .'<div class="col-sm-6">'.
                     Form::number('max_qty',@$results['max_qty'], array('class' => 'form-control view-readonly','readonly' => 'readonly')) 
                .'</div>
            </div>'
        : '' !!}
                                                                
        {!! (!empty( $arrShowFieldView['warehouse_item_desc'] ))?
            '<div class="form-group">'.
                Form::label('warehouse_item_desc', __("warehouse_item.label_warehouse_item_desc"), array('class' => 'col-sm-3 control-label'))
            .'<div class="col-sm-6">'.              
                Form::textarea('warehouse_item_desc', @$results['warehouse_item_desc'], array('class' => 'form-control view-readonly' ,'readonly' => 'readonly'))
            .'</div>
            </div>'
        : '' !!}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
        {!! (!empty( $arrShowFieldView['active'] ))?           
            '<div class="form-group">'.              
                Form::label('active', __("warehouse_item.label_active"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('active', trans( "warehouse_item.active_label.".$results['active'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                .'</div>
            </div>'
        : '' !!}
                            
    </form>
        <div class="ln_solid"></div>          
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!! _createButtonBack('warehouse_items') !!}
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
 * File Create : 2018-05-15 22:59:05 *
 */
-->