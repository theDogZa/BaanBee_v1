@extends('layouts.app')
@section('title')
{{ ucfirst(__('item.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title x_ul">
        <div class="nav navbar-left">
            <ul id="ityemTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
                        <h2>
                            <i class="fa fa-eye" aria-hidden="true"></i> {{ ucfirst(__('item.head_view')) }}
                        </h2>
                    </a>
                </li>
                <li role="presentation" class="">
                    <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
                        <h2>
                            {!! config('core.icon.title_from_list') !!} {!!  ucfirst(__('item.head_list_item_warehouse'))  !!}
                        </h2>
                    </a>
                </li>
                <li role="presentation" class="">
                    <a href="#tab_content3" role="tab" id="sale-tab" data-toggle="tab" aria-expanded="false">
                        <h2>
                            {!! config('core.icon.title_from_sale') !!} {!!  ucfirst(__('item.head_list_item_sale'))  !!}
                        </h2>
                    </a>
                </li>
            </ul>
        </div>
        <div class="nav navbar-right">
            @include('partials._panel_toolbox')
        </div>
        <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content"> 
    <div id="myTabContent" class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">          
            <form action="{{ url('/posts') }}" method="POST" class="form-horizontal">        
                                                
                {!! (!empty( $arrShowFieldView['item_categorie_id'] ))?
                    '<div class="form-group">'.              
                        Form::label('item_categorie_id', __("item.label_item_categorie_id"), array('class' => 'col-sm-3 control-label'))
                        .'<div class="col-sm-6">'.
                            Form::text('item_categorie_id',  @$Item_category[@$results['item_categorie_id']]  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                        .'</div>
                    </div>'
                : '' !!}
                                                        
                {!! (!empty( $arrShowFieldView['item_size_id'] ))?
                    '<div class="form-group">'.              
                        Form::label('item_size_id', __("item.label_item_size_id"), array('class' => 'col-sm-3 control-label'))
                        .'<div class="col-sm-6">'.
                            Form::text('item_size_id',  @$Item_size[@$results['item_size_id']]  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                        .'</div>
                    </div>'
                : '' !!}
                                                        
                {!! (!empty( $arrShowFieldView['item_color_id'] ))?
                    '<div class="form-group">'.              
                        Form::label('item_color_id', __("item.label_item_color_id"), array('class' => 'col-sm-3 control-label'))
                        .'<div class="col-sm-6">'.
                            Form::text('item_color_id',  @$Item_color[@$results['item_color_id']]  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                        .'</div>
                    </div>'
                : '' !!}
                                                        
                {!! (!empty( $arrShowFieldView['item_unit_id'] ))?
                    '<div class="form-group">'.              
                        Form::label('item_unit_id', __("item.label_item_unit_id"), array('class' => 'col-sm-3 control-label'))
                        .'<div class="col-sm-6">'.
                            Form::text('item_unit_id',  @$Item_unit[@$results['item_unit_id']]  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                        .'</div>
                    </div>'
                : '' !!}
                                
                {!! (!empty( $arrShowFieldView['item_name'] ))?
                    '<div class="form-group">'.
                        Form::label('item_name', __("item.label_item_name"), array('class' => 'col-sm-3 control-label')) 
                        .'<div class="col-sm-6">'.
                            Form::text('item_name', @$results['item_name'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                        .'</div>
                    </div>'
                : '' !!}
                                                        
                {!! (!empty( $arrShowFieldView['item_code'] ))?
                    '<div class="form-group">'.
                        Form::label('item_code', __("item.label_item_code"), array('class' => 'col-sm-3 control-label')) 
                        .'<div class="col-sm-6">'.
                            Form::text('item_code', @$results['item_code'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                        .'</div>
                    </div>'
                : '' !!}
                                                        
                {!! (!empty( $arrShowFieldView['item_num'] ))?
                    '<div class="form-group">'.
                        Form::label('item_num', __("item.label_item_num"), array('class' => 'col-sm-3 control-label')) 
                        .'<div class="col-sm-6">'.
                            Form::text('item_num', @$results['item_num'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                        .'</div>
                    </div>'
                : '' !!}
                                                                
                {!! (!empty( $arrShowFieldView['item_sale_price'] ))?
                    '<div class="form-group">'.
                        Form::label('item_sale_price', __("item.label_item_sale_price"), array('class' => 'col-sm-3 control-label')) 
                        .'<div class="col-sm-6">'.
                            Form::number('item_sale_price',@$results['item_sale_price'], array('class' => 'form-control view-readonly','readonly' => 'readonly')) 
                        .'</div>
                    </div>'
                : '' !!}
                                                        
                {!! (!empty( $arrShowFieldView['item_cost_price'] ))?
                    '<div class="form-group">'.
                        Form::label('item_cost_price', __("item.label_item_cost_price"), array('class' => 'col-sm-3 control-label')) 
                        .'<div class="col-sm-6">'.
                            Form::number('item_cost_price',@$results['item_cost_price'], array('class' => 'form-control view-readonly','readonly' => 'readonly')) 
                        .'</div>
                    </div>'
                : '' !!}
                                                        
                {!! (!empty( $arrShowFieldView['item_qty'] ))?
                    '<div class="form-group">'.
                        Form::label('item_qty', __("item.label_item_qty"), array('class' => 'col-sm-3 control-label')) 
                        .'<div class="col-sm-6">'.
                            Form::number('item_qty',@$results['item_qty'], array('class' => 'form-control view-readonly','readonly' => 'readonly')) 
                        .'</div>
                    </div>'
                : '' !!}
                                                        
                {!! (!empty( $arrShowFieldView['item_qty_min'] ))?
                    '<div class="form-group">'.
                        Form::label('item_qty_min', __("item.label_item_qty_min"), array('class' => 'col-sm-3 control-label')) 
                        .'<div class="col-sm-6">'.
                            Form::number('item_qty_min',@$results['item_qty_min'], array('class' => 'form-control view-readonly','readonly' => 'readonly')) 
                        .'</div>
                    </div>'
                : '' !!}
                                                        
                {!! (!empty( $arrShowFieldView['item_qty_max'] ))?
                    '<div class="form-group">'.
                        Form::label('item_qty_max', __("item.label_item_qty_max"), array('class' => 'col-sm-3 control-label')) 
                        .'<div class="col-sm-6">'.
                            Form::number('item_qty_max',@$results['item_qty_max'], array('class' => 'form-control view-readonly','readonly' => 'readonly')) 
                        .'</div>
                    </div>'
                : '' !!}
                                                        
                {!! (!empty( $arrShowFieldView['item_sale_qty'] ))?
                    '<div class="form-group">'.
                        Form::label('item_sale_qty', __("item.label_item_sale_qty"), array('class' => 'col-sm-3 control-label')) 
                        .'<div class="col-sm-6">'.
                            Form::number('item_sale_qty',@$results['item_sale_qty'], array('class' => 'form-control view-readonly','readonly' => 'readonly')) 
                        .'</div>
                    </div>'
                : '' !!}
                                                                        
                {!! (!empty( $arrShowFieldView['item_desc'] ))?
                    '<div class="form-group">'.
                        Form::label('item_desc', __("item.label_item_desc"), array('class' => 'col-sm-3 control-label'))
                    .'<div class="col-sm-6">'.              
                        Form::textarea('item_desc', @$results['item_desc'], array('class' => 'form-control view-readonly' ,'readonly' => 'readonly'))
                    .'</div>
                    </div>'
                : '' !!}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                {!! (!empty( $arrShowFieldView['active'] ))?           
                    '<div class="form-group">'.              
                        Form::label('active', __("item.label_active"), array('class' => 'col-sm-3 control-label'))
                        .'<div class="col-sm-6">'.
                            Form::text('active', trans( "item.active_label.".$results['active'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                        .'</div>
                    </div>'
                : '' !!}
                                    
            </form>
            <div class="ln_solid"></div>          
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    {!! _createButtonBack('items') !!}
                </div>
            </div>
            </div> 
            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="item_warehouse-tab">
                @include('items.item_warehouse');
            </div>
            <!--/.tab_content2 -->
            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="sale-tab">
            </div>
            <!--/.tab_content3 -->
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
 * File Create : 2018-04-28 22:12:49 *
 */
-->