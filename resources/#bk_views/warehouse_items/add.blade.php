@extends('layouts.app')
@section('title')
{{ ucfirst(__('warehouse_item.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2>
    {!! config('core.icon.title_from') !!}
    {!! (!isset($warehouse_item))?
        ucfirst(__('warehouse_item.head_from_add'))  :  ucfirst(__('warehouse_item.head_from_edit'))
    !!}
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
    <form action="{{ url('/warehouse_items'.( isset($warehouse_item) ? "/" . $warehouse_item->id : "")) }}" method="POST" class="form-horizontal form-process" id="form" >
            {{ csrf_field() }}      
         
            @if(isset($warehouse_item))                
                {{ Form::hidden('_method','PATCH') }}
            @endif  


        {!! (!empty( $arrShowFieldFrom['warehouse_id'] ))?       
            '<div class="form-group">'.               
                Form::label('warehouse_id', __("warehouse_item.label_warehouse_id").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::select('warehouse_id',['' => '']+$Warehouse, @$warehouse_item['warehouse_id'] , array('placeholder'=>__("warehouse_item.placeholder_warehouse_id"),'class' => 'select2_single form-control','required','','data-parsley-errors-container'=>'#errors-messages-box-warehouse_id' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("warehouse_item.label_warehouse_id")]) ))
                    .'<span id="errors-messages-box-warehouse_id"></span>
                </div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['item_id'] ))?       
            '<div class="form-group">'.               
                Form::label('item_id', __("warehouse_item.label_item_id").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::select('item_id',['' => '']+$Item, @$warehouse_item['item_id'] , array('placeholder'=>__("warehouse_item.placeholder_item_id"),'class' => 'select2_single form-control','required','','data-parsley-errors-container'=>'#errors-messages-box-item_id' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("warehouse_item.label_item_id")]) ))
                    .'<span id="errors-messages-box-item_id"></span>
                </div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['qty'] ))?       
            '<div class="form-group">'.
                Form::label('qty', __("warehouse_item.label_qty").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::number('qty',@$warehouse_item['qty'], array('placeholder'=>__("warehouse_item.placeholder_qty"),'class' => 'form-control', 'id' => 'qty','step'=>'0.0001','required','' ,  'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("warehouse_item.label_qty")]) ))
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['min_qty'] ))?       
            '<div class="form-group">'.
                Form::label('min_qty', __("warehouse_item.label_min_qty").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::number('min_qty',@$warehouse_item['min_qty'], array('placeholder'=>__("warehouse_item.placeholder_min_qty"),'class' => 'form-control', 'id' => 'min_qty','step'=>'0.0001','','' ,  'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("warehouse_item.label_min_qty")]) ))
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['max_qty'] ))?       
            '<div class="form-group">'.
                Form::label('max_qty', __("warehouse_item.label_max_qty").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::number('max_qty',@$warehouse_item['max_qty'], array('placeholder'=>__("warehouse_item.placeholder_max_qty"),'class' => 'form-control', 'id' => 'max_qty','step'=>'0.0001','','' ,  'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("warehouse_item.label_max_qty")]) ))
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['warehouse_item_desc'] ))?
            '<div class="form-group">'.
                Form::label('warehouse_item_desc', __("warehouse_item.label_warehouse_item_desc").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.               
                Form::textarea('warehouse_item_desc', @$warehouse_item['warehouse_item_desc'], array('placeholder'=>__("warehouse_item.placeholder_warehouse_item_desc"),'class' => 'form-control text-editor','','', 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("warehouse_item.label_warehouse_item_desc")]) ))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['active'] ))?
            '<div class="form-group">'.
                Form::label('active', __("warehouse_item.label_active").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.             
                     _createRadio('active',@$warehouse_item['active'])
                .'</div>
            </div>'
        : '' !!}
        
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!!  _createButtonSubmit() !!}
                {!!  _createButtonReset() !!}
                {!! _createButtonBack('warehouse_items') !!}              
            </div>
        </div>
    </form>
  </div>
  <!--/.x_content -->
</div>
<!--/.x_panel -->
@endsection

@section('scripts')

<script src="{{asset('vendors/validator-parsley/parsley.js')}}"></script>
<script src="{{asset('vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
<link href="{{asset('vendors/datetimepicker/bootstrap-datetimepicker.css')}}" rel="stylesheet">
<script src="{{asset('vendors/datetimepicker/bootstrap-datetimepicker.js')}}"></script>
<script src="{{asset('vendors/datetimepicker/locales/bootstrap-datepicker.th.min.js')}}"></script>
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
    $('.select2_single').select2({
        placeholder: '{{ __("core.placeholder_select") }}',
        allowClear: true
    }).on('change', function() {       
       $(this).parsley().validate();  
    });

    $('.datetimepicker').datetimepicker().on('change', function() {       
       $(this).find('input').parsley().validate();   
    });

    $(":input").inputmask();
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
 * File Create : 2018-05-15 22:59:05 *
 */
-->