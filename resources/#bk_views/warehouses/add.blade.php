@extends('layouts.app')
@section('title')
{{ ucfirst(__('warehouse.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2>
    {!! config('core.icon.title_from') !!}
    {!! (!isset($warehouse))?
        ucfirst(__('warehouse.head_from_add'))  :  ucfirst(__('warehouse.head_from_edit'))
    !!}
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
    <form action="{{ url('/warehouses'.( isset($warehouse) ? "/" . $warehouse->id : "")) }}" method="POST" class="form-horizontal form-process" id="form" >
            {{ csrf_field() }}      
         
            @if(isset($warehouse))                
                {{ Form::hidden('_method','PATCH') }}
            @endif  


        {!! (!empty( $arrShowFieldFrom['warehouse_name'] ))?       
            '<div class="form-group">'.
                Form::label('warehouse_name', __("warehouse.label_warehouse_name").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('warehouse_name', @$warehouse['warehouse_name'], 
                    array('placeholder'=>__("warehouse.placeholder_warehouse_name"),'class' => 'form-control','id' => 'warehouse_name' ,'required','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("warehouse.label_warehouse_name")]) ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['warehouse_code'] ))?       
            '<div class="form-group">'.
                Form::label('warehouse_code', __("warehouse.label_warehouse_code").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('warehouse_code', @$warehouse['warehouse_code'], 
                    array('placeholder'=>__("warehouse.placeholder_warehouse_code"),'class' => 'form-control','id' => 'warehouse_code' ,'required','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("warehouse.label_warehouse_code")]) ))                
                .'</div>
            </div>'
        : '' !!} 

         {!! (!empty( $arrShowFieldFrom['warehouse_address'] ))?
            '<div class="form-group">'.
                Form::label('warehouse_address', __("warehouse.label_warehouse_address").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.               
                Form::textarea('warehouse_address', @$warehouse['warehouse_address'], array('placeholder'=>__("warehouse.placeholder_warehouse_address"),'class' => 'form-control text-editor','required','', 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("warehouse.label_warehouse_address")]) ))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['province_id'] ))?       
            '<div class="form-group">'.               
                Form::label('province_id', __("warehouse.label_province_id").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::select('province_id',['' => '']+$Province, @$warehouse['province_id'] , array('placeholder'=>__("warehouse.placeholder_province_id"),'class' => 'select2_single form-control','required','','data-parsley-errors-container'=>'#errors-messages-box-province_id' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("warehouse.label_province_id")]) ))
                    .'<span id="errors-messages-box-province_id"></span>
                </div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['warehouse_tel1'] ))?       
            '<div class="form-group">'.
                Form::label('warehouse_tel1', __("warehouse.label_warehouse_tel1").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('warehouse_tel1', @$warehouse['warehouse_tel1'], 
                    array('placeholder'=>__("warehouse.placeholder_warehouse_tel1"),'class' => 'form-control','id' => 'warehouse_tel1' ,'','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("warehouse.label_warehouse_tel1")]) ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['warehouse_tel2'] ))?       
            '<div class="form-group">'.
                Form::label('warehouse_tel2', __("warehouse.label_warehouse_tel2").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('warehouse_tel2', @$warehouse['warehouse_tel2'], 
                    array('placeholder'=>__("warehouse.placeholder_warehouse_tel2"),'class' => 'form-control','id' => 'warehouse_tel2' ,'','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("warehouse.label_warehouse_tel2")]) ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['warehouse_desc'] ))?
            '<div class="form-group">'.
                Form::label('warehouse_desc', __("warehouse.label_warehouse_desc").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.               
                Form::textarea('warehouse_desc', @$warehouse['warehouse_desc'], array('placeholder'=>__("warehouse.placeholder_warehouse_desc"),'class' => 'form-control text-editor','','', 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("warehouse.label_warehouse_desc")]) ))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['active'] ))?
            '<div class="form-group">'.
                Form::label('active', __("warehouse.label_active").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.             
                     _createRadio('active',@$warehouse['active'])
                .'</div>
            </div>'
        : '' !!}
        
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!!  _createButtonSubmit() !!}
                {!!  _createButtonReset() !!}
                {!! _createButtonBack('warehouses') !!}              
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
 * File Create : 2018-05-15 22:39:53 *
 */
-->