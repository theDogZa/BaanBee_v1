@extends('layouts.app')
@section('title')
{{ ucfirst(__('item.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
    <div class="x_title x_ul">
        <div class="nav navbar-left">
        <!--  config('core.module.warehouses') === true?  -->
@if(!empty(config('core.module.warehouses')))   
            @if(isset($item))
            <ul id="ityemTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
                        <h2>
                            {!! config('core.icon.title_from') !!} {!! ucfirst(__('item.head_from_edit')) !!}
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
            @endif 
@endif 
       <!-- : '' -->

             {!! (!isset($item))?
                '<h2>'.config('core.icon.title_from'). " " .ucfirst(__('item.head_from_add'))  :  ""  .'</h2>'
             !!}
        </div>
        <div class="nav navbar-right">
            @include('partials._panel_toolbox')
        </div>
        <div class="clearfix"></div>
    </div>
    <!--/.x_title -->
    <div class="x_content">
        @if(isset($item)) 
        <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
        @endif
                <form action="{{ url('/items'.( isset($item) ? " / " . $item->id : " ")) }}" method="POST" class="form-horizontal form-process"id="form">
                    <div class="row">
                        {{ csrf_field() }} @if(isset($item)) {{ Form::hidden('_method','PATCH') }} @endif {!! (!empty( $arrShowFieldFrom['item_categorie_id'] ))? '
                        <div class="'.config('core.layout.form.add.box').'">'. Form::label('item_categorie_id', __("item.label_item_categorie_id").' *', array('class' => config("core.layout.form.add.label")))
                            .'
                            <div class="'.config('core.layout.form.add.input').'">'. Form::select('item_categorie_id',['' => '']+$Item_category, @$item['item_categorie_id'] , array('placeholder'=>__("item.placeholder_item_categorie_id"),'class'
                                => 'select2_single form-control','required','','data-parsley-errors-container'=>'#errors-messages-box-item_categorie_id'
                                , 'data-parsley-error-message' => __("validation.required", ['attribute' => __("item.label_item_categorie_id")])
                                )) .'
                                <span id="errors-messages-box-item_categorie_id"></span>
                            </div>
                        </div>' : '' !!} {!! (!empty( $arrShowFieldFrom['item_size_id'] ))? '
                        <div class="'.config('core.layout.form.add.box').'">'. Form::label('item_size_id', __("item.label_item_size_id").' *', array('class' => config("core.layout.form.add.label"))) .'
                            <div class="'.config('core.layout.form.add.input').'">'. Form::select('item_size_id',['' => '']+$Item_size, @$item['item_size_id'] , array('placeholder'=>__("item.placeholder_item_size_id"),'class'
                                => 'select2_single form-control','required','','data-parsley-errors-container'=>'#errors-messages-box-item_size_id'
                                , 'data-parsley-error-message' => __("validation.required", ['attribute' => __("item.label_item_size_id")]) ))
                                .'
                                <span id="errors-messages-box-item_size_id"></span>
                            </div>
                        </div>' : '' !!} {!! (!empty( $arrShowFieldFrom['item_color_id'] ))? '
                        <div class="'.config('core.layout.form.add.box').'">'. Form::label('item_color_id', __("item.label_item_color_id").' *', array('class' => config("core.layout.form.add.label"))) .'
                            <div class="'.config('core.layout.form.add.input').'">'. Form::select('item_color_id',['' => '']+$Item_color, @$item['item_color_id'] , array('placeholder'=>__("item.placeholder_item_color_id"),'class'
                                => 'select2_single form-control','required','','data-parsley-errors-container'=>'#errors-messages-box-item_color_id'
                                , 'data-parsley-error-message' => __("validation.required", ['attribute' => __("item.label_item_color_id")])
                                )) .'
                                <span id="errors-messages-box-item_color_id"></span>
                            </div>
                        </div>' : '' !!} {!! (!empty( $arrShowFieldFrom['item_unit_id'] ))? '
                        <div class="'.config('core.layout.form.add.box').'">'. Form::label('item_unit_id', __("item.label_item_unit_id").' *', array('class' => config("core.layout.form.add.label"))) .'
                            <div class="'.config('core.layout.form.add.input').'">'. Form::select('item_unit_id',['' => '']+$Item_unit, isset($item)? @$item['item_unit_id'] : 1, array('placeholder'=>__("item.placeholder_item_unit_id"),'class'
                                => 'select2_single form-control','required','','data-parsley-errors-container'=>'#errors-messages-box-item_unit_id'
                                , 'data-parsley-error-message' => __("validation.required", ['attribute' => __("item.label_item_unit_id")]) ))
                                .'
                                <span id="errors-messages-box-item_unit_id"></span>
                            </div>
                        </div>' : '' !!} {!! (!empty( $arrShowFieldFrom['item_name'] ))? '
                        <div class="'.config('core.layout.form.add.box').'">'. Form::label('item_name', __("item.label_item_name").' *', array('class' => config("core.layout.form.add.label"))) .'
                            <div class="'.config('core.layout.form.add.input').'">'. Form::text('item_name', @$item['item_name'], array('placeholder'=>__("item.placeholder_item_name"),'class' =>
                                'form-control','id' => 'item_name' ,'required','' , 'data-parsley-error-message' => __("validation.required",
                                ['attribute' => __("item.label_item_name")]) )) .'
                            </div>
                        </div>' : '' !!} {!! (!empty( $arrShowFieldFrom['item_code'] ))? '
                        <div class="'.config('core.layout.form.add.box').'">'. Form::label('item_code', __("item.label_item_code").' *', array('class' => config("core.layout.form.add.label"))) .'
                            <div class="'.config('core.layout.form.add.input').'">'. Form::text('item_code', @$item['item_code'], array('placeholder'=>__("item.placeholder_item_code"),'class' =>
                                'form-control','id' => 'item_code' ,'required','readonly' => 'readonly' , 'data-parsley-error-message' => __("validation.required",
                                ['attribute' => __("item.label_item_code")]) )) .'
                            </div>
                        </div>' : '' !!} {!! (!empty( $arrShowFieldFrom['item_num'] ))? '
                        <div class="'.config('core.layout.form.add.box').'">'. Form::label('item_num', __("item.label_item_num").' *', array('class' => config("core.layout.form.add.label"))) .'
                            <div class="'.config('core.layout.form.add.input').'">'. Form::text('item_num', @$item['item_num'], array('placeholder'=>__("item.placeholder_item_num"),'class' => 'form-control','id'
                                => 'item_num' ,'required','' , 'data-parsley-error-message' => __("validation.required", ['attribute' => __("item.label_item_num")])
                                )) .'
                            </div>
                        </div>' : '' !!} {!! (!empty( $arrShowFieldFrom['item_sale_price'] ))? '
                        <div class="'.config('core.layout.form.add.box').'">'. Form::label('item_sale_price', __("item.label_item_sale_price").' *', array('class' => config("core.layout.form.add.label")))
                            .'
                            <div class="'.config('core.layout.form.add.input').'">'. Form::number('item_sale_price',@$item['item_sale_price'], array('placeholder'=>__("item.placeholder_item_sale_price"),'class'
                                => 'form-control', 'id' => 'item_sale_price','step'=>'0.0001','required','' , 'data-parsley-error-message' =>
                                __("validation.required", ['attribute' => __("item.label_item_sale_price")]) )) .'
                            </div>
                        </div>' : '' !!} {!! (!empty( $arrShowFieldFrom['item_cost_price'] ))? '
                        <div class="'.config('core.layout.form.add.box').'">'. Form::label('item_cost_price', __("item.label_item_cost_price").' ', array('class' => config("core.layout.form.add.label"))) .'
                            <div class="'.config('core.layout.form.add.input').'">'. Form::number('item_cost_price',@$item['item_cost_price'], array('placeholder'=>__("item.placeholder_item_cost_price"),'class'
                                => 'form-control', 'id' => 'item_cost_price','step'=>'0.0001','','' , 'data-parsley-error-message' => __("validation.required",
                                ['attribute' => __("item.label_item_cost_price")]) )) .'
                            </div>
                        </div>' : '' !!} {!! (!empty( $arrShowFieldFrom['item_qty'] ))? '
                        <div class="'.config('core.layout.form.add.box').'">'. Form::label('item_qty', __("item.label_item_qty").' ', array('class' => config("core.layout.form.add.label"))) .'
                            <div class="'.config('core.layout.form.add.input').'">'. Form::number('item_qty',@$item['item_qty'], array('placeholder'=>__("item.placeholder_item_qty"),'class' => 'form-control',
                                'id' => 'item_qty','step'=>'0.0001','readonly' => 'readonly' ,'' , 'data-parsley-error-message' => __("validation.required", ['attribute'
                                => __("item.label_item_qty")]) )) .'
                            </div>
                        </div>' : '' !!} {!! (!empty( $arrShowFieldFrom['item_qty_min'] ))? '
                        <div class="'.config('core.layout.form.add.box').'">'. Form::label('item_qty_min', __("item.label_item_qty_min").' ', array('class' => config("core.layout.form.add.label"))) .'
                            <div class="'.config('core.layout.form.add.input').'">'. Form::number('item_qty_min',@$item['item_qty_min'], array('placeholder'=>__("item.placeholder_item_qty_min"),'class'
                                => 'form-control', 'id' => 'item_qty_min','step'=>'0.0001','','' , 'data-parsley-error-message' => __("validation.required",
                                ['attribute' => __("item.label_item_qty_min")]) )) .'
                            </div>
                        </div>' : '' !!} {!! (!empty( $arrShowFieldFrom['item_qty_max'] ))? '
                        <div class="'.config('core.layout.form.add.box').'">'. Form::label('item_qty_max', __("item.label_item_qty_max").' ', array('class' => config("core.layout.form.add.label"))) .'
                            <div class="'.config('core.layout.form.add.input').'">'. Form::number('item_qty_max',@$item['item_qty_max'], array('placeholder'=>__("item.placeholder_item_qty_max"),'class'
                                => 'form-control', 'id' => 'item_qty_max','step'=>'0.0001','','' , 'data-parsley-error-message' => __("validation.required",
                                ['attribute' => __("item.label_item_qty_max")]) )) .'
                            </div>
                        </div>' : '' !!} {!! (!empty( $arrShowFieldFrom['item_sale_qty'] ))? '
                        <div class="'.config('core.layout.form.add.box').'">'. Form::label('item_sale_qty', __("item.label_item_sale_qty").' ', array('class' => config("core.layout.form.add.label"))) .'
                            <div class="'.config('core.layout.form.add.input').'">'. Form::number('item_sale_qty',@$item['item_sale_qty'], array('placeholder'=>__("item.placeholder_item_sale_qty"),'class'
                                => 'form-control', 'id' => 'item_sale_qty','step'=>'0.0001','','' , 'data-parsley-error-message' => __("validation.required",
                                ['attribute' => __("item.label_item_sale_qty")]) )) .'
                            </div>
                        </div>' : '' !!} {!! (!empty( $arrShowFieldFrom['item_desc'] ))? '
                        <div class="'.config('core.layout.form.add.box').'">'. Form::label('item_desc', __("item.label_item_desc").' ', array('class' => config("core.layout.form.add.label"))) .'
                            <div class="'.config('core.layout.form.add.input').'">'. Form::textarea('item_desc', @$item['item_desc'], array('rows'=> config("core.layout.input.textarea.rows"),'placeholder'=>__("item.placeholder_item_desc"),'class'
                                => 'form-control text-editor','','', 'data-parsley-error-message' => __("validation.required", ['attribute' =>
                                __("item.label_item_desc")]) )) .'
                            </div>
                        </div>' : '' !!} {!! (!empty( $arrShowFieldFrom['active'] ))? '
                        <div class="'.config('core.layout.form.add.box').'">'. Form::label('active', __("item.label_active").' ', array('class' => config("core.layout.form.add.label"))) .'
                            <div class="'.config('core.layout.form.add.input').'">'. _createRadio('active',@$item['active']) .'
                            </div>
                        </div>' : '' !!}
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="{!! config('core.layout.form.add.button') !!}">
                            {!! _createButtonSubmit() !!} {!! _createButtonReset() !!} {!! _createButtonBack('items') !!}
                        </div>
                    </div>
                </form>
                
            @if(isset($item)) 
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="item_warehouse-tab">
                @include('items.item_warehouse');
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="sale-tab">
            </div>
        </div>
        <!--/ .tab-content -->
        
       
        @endif
    </div>
    <!--/.x_content -->
</div>
<!--/.x_panel -->
@endsection

@section('scripts')

<script src="{{asset('vendors/validator-parsley/parsley.js')}}"></script>
<!-- <script src="{{asset('vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
<link href="{{asset('vendors/datetimepicker/bootstrap-datetimepicker.css')}}" rel="stylesheet">
<script src="{{asset('vendors/datetimepicker/bootstrap-datetimepicker.js')}}"></script>
<script src="{{asset('vendors/datetimepicker/locales/bootstrap-datepicker.th.min.js')}}"></script> -->
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet">
<script src="{{asset('vendors/select2/js/select2.full.min.js')}}"></script>

<script type="text/javascript">
    $_form = '#form';
    var olddata = $($_form).serialize();
    $(function () {
        $($_form).parsley({
            successClass: 'has-success',
            errorClass: 'has-error',
            classHandler: function(el) {
                return el.$element.closest(".form-group");
            },          
            //errorsWrapper: '<span class="help-block"></span>',
            //errorTemplate: "<span></span>"
        });

        $($_form).parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        })
        .on('form:submit', function() {
            //return false;
            var newdata = $($_form).serialize();
		    if(olddata==newdata){
                dataNotChangeMessage();
                return false;
            }
        });
    });

    $(document).ready(function() { 

    $("#item_categorie_id").select2().on('change', function() {       
        var item_categorie_id = $("#item_categorie_id").val();  
        $.get('/items/genItemCode/{{@$item->id}}',{'item_categorie_id':item_categorie_id}).done(function(data) {
            $("#item_code").val(data);
        });
    });
   
    $('.select2_single').select2({
        placeholder: '{{ __("core.placeholder_select") }}',
        allowClear: true
    }).on('change', function() {       
       $(this).parsley().validate();  
    });

    // $('.datetimepicker').datetimepicker().on('change', function() {       
    //    $(this).find('input').parsley().validate();   
    // });

   // $(":input").inputmask();
 });
    
</script>
@endsection



<!--
/** 
 * CRUD Laravel
 * Master ฺBY Kepex  =>  https://github.com/kEpEx/laravel-crud-generator
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 13/04/2018 18:28
 * Version : ver.1.00.00
 *
 * File Create : 2018-04-28 22:12:49 *
 */
-->