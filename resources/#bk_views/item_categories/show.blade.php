@extends('layouts.app')
@section('title')
{{ ucfirst(__('item_category.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-eye" aria-hidden="true"></i> {{ ucfirst(__('item_category.head_view')) }}  </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">           
    <form action="{{ url('/posts') }}" method="POST" class="form-horizontal">        
                                        
        {!! (!empty( $arrShowFieldView['item_type_id'] ))?
            '<div class="form-group">'.              
                Form::label('item_type_id', __("item_category.label_item_type_id"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('item_type_id',  @$Item_type[@$results['item_type_id']]  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                .'</div>
            </div>'
        : '' !!}
                        
        {!! (!empty( $arrShowFieldView['categories_name'] ))?
            '<div class="form-group">'.
                 Form::label('categories_name', __("item_category.label_categories_name"), array('class' => 'col-sm-3 control-label')) 
                .'<div class="col-sm-6">'.
                     Form::text('categories_name', @$results['categories_name'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                
        {!! (!empty( $arrShowFieldView['categories_code'] ))?
            '<div class="form-group">'.
                 Form::label('categories_code', __("item_category.label_categories_code"), array('class' => 'col-sm-3 control-label')) 
                .'<div class="col-sm-6">'.
                     Form::text('categories_code', @$results['categories_code'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                                        
        {!! (!empty( $arrShowFieldView['categories_desc'] ))?
            '<div class="form-group">'.
                Form::label('categories_desc', __("item_category.label_categories_desc"), array('class' => 'col-sm-3 control-label'))
            .'<div class="col-sm-6">'.              
                Form::textarea('categories_desc', @$results['categories_desc'], array('class' => 'form-control view-readonly' ,'readonly' => 'readonly'))
            .'</div>
            </div>'
        : '' !!}
                                                                                                                                                                                                                                                                                                                                                                                                        
        {!! (!empty( $arrShowFieldView['active'] ))?           
            '<div class="form-group">'.              
                Form::label('active', __("item_category.label_active"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('active', trans( "item_category.active_label.".$results['active'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                .'</div>
            </div>'
        : '' !!}
                            
    </form>
        <div class="ln_solid"></div>          
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!! _createButtonBack('item_categories') !!}
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
 * File Create : 2018-04-28 17:51:42 *
 */
-->