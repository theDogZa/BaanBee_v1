@extends('layouts.app')
@section('title')
{{ ucfirst(__('item_adjusted_type.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2>
    {!! config('core.icon.title_from') !!}
    {!! (!isset($item_adjusted_type))?
        ucfirst(__('item_adjusted_type.head_from_add'))  :  ucfirst(__('item_adjusted_type.head_from_edit'))
    !!}
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
    <form action="{{ url('/item_adjusted_types'.( isset($item_adjusted_type) ? "/" . $item_adjusted_type->id : "")) }}" method="POST" class="form-horizontal form-process" id="form" >
            {{ csrf_field() }}      
         
            @if(isset($item_adjusted_type))                
                {{ Form::hidden('_method','PATCH') }}
            @endif  


        {!! (!empty( $arrShowFieldFrom['adjusted_type_codes'] ))?       
            '<div class="form-group">'.
                Form::label('adjusted_type_codes', __("item_adjusted_type.label_adjusted_type_codes").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('adjusted_type_codes', @$item_adjusted_type['adjusted_type_codes'], 
                    array('placeholder'=>__("item_adjusted_type.placeholder_adjusted_type_codes"),'class' => 'form-control','id' => 'adjusted_type_codes' ,'required','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_adjusted_type.label_adjusted_type_codes")]) ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['adjusted_type_name_th'] ))?       
            '<div class="form-group">'.
                Form::label('adjusted_type_name_th', __("item_adjusted_type.label_adjusted_type_name_th").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('adjusted_type_name_th', @$item_adjusted_type['adjusted_type_name_th'], 
                    array('placeholder'=>__("item_adjusted_type.placeholder_adjusted_type_name_th"),'class' => 'form-control','id' => 'adjusted_type_name_th' ,'','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_adjusted_type.label_adjusted_type_name_th")]) ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['adjusted_type_name_en'] ))?       
            '<div class="form-group">'.
                Form::label('adjusted_type_name_en', __("item_adjusted_type.label_adjusted_type_name_en").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('adjusted_type_name_en', @$item_adjusted_type['adjusted_type_name_en'], 
                    array('placeholder'=>__("item_adjusted_type.placeholder_adjusted_type_name_en"),'class' => 'form-control','id' => 'adjusted_type_name_en' ,'','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_adjusted_type.label_adjusted_type_name_en")]) ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['adjusted_type_desc'] ))?
            '<div class="form-group">'.
                Form::label('adjusted_type_desc', __("item_adjusted_type.label_adjusted_type_desc").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.               
                Form::textarea('adjusted_type_desc', @$item_adjusted_type['adjusted_type_desc'], array('placeholder'=>__("item_adjusted_type.placeholder_adjusted_type_desc"),'class' => 'form-control text-editor','','', 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_adjusted_type.label_adjusted_type_desc")]) ))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['active'] ))?
            '<div class="form-group">'.
                Form::label('active', __("item_adjusted_type.label_active").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.             
                     _createRadio('active',@$item_adjusted_type['active'])
                .'</div>
            </div>'
        : '' !!}
        
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!!  _createButtonSubmit() !!}
                {!!  _createButtonReset() !!}
                {!! _createButtonBack('item_adjusted_types') !!}              
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
 * File Create : 2018-07-24 01:07:15 *
 */
-->