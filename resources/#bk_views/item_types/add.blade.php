@extends('layouts.app')
@section('title')
{{ ucfirst(__('item_type.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2>
    {!! config('core.icon.title_from') !!}
    {!! (!isset($item_type))?
        ucfirst(__('item_type.head_from_add'))  :  ucfirst(__('item_type.head_from_edit'))
    !!}
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
    <form action="{{ url('/item_types'.( isset($item_type) ? "/" . $item_type->id : "")) }}" method="POST" class="form-horizontal form-process" id="form" >
            {{ csrf_field() }}      
         
            @if(isset($item_type))                
                {{ Form::hidden('_method','PATCH') }}
            @endif  


        {!! (!empty( $arrShowFieldFrom['type_name'] ))?       
            '<div class="form-group">'.
                Form::label('type_name', __("item_type.label_type_name").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('type_name', @$item_type['type_name'], 
                    array('placeholder'=>__("item_type.placeholder_type_name"),'class' => 'form-control','id' => 'type_name' ,'required','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_type.label_type_name")]) ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['type_code'] ))?       
            '<div class="form-group">'.
                Form::label('type_code', __("item_type.label_type_code").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('type_code', @$item_type['type_code'], 
                    array('placeholder'=>__("item_type.placeholder_type_code"),'class' => 'form-control','id' => 'type_code' ,'required',
                    'data-parsley-required-message' =>  __("validation.required", ['attribute' => __("item_type.label_type_code")]),
                    'data-parsley-remote'=>url("/item_types/checkCode/".@$item_type['id']),
                    'data-parsley-remote-reverse'=> 'true',
                    'data-parsley-remote-message'=>  __("validation.unique", ['attribute' => __("item_type.label_type_code")]), 
                    ))             
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['type_desc'] ))?
            '<div class="form-group">'.
                Form::label('type_desc', __("item_type.label_type_desc").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.               
                Form::textarea('type_desc', @$item_type['type_desc'], array('placeholder'=>__("item_type.placeholder_type_desc"),'class' => 'form-control text-editor','','', 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_type.label_type_desc")]) ))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['active'] ))?
            '<div class="form-group">'.
                Form::label('active', __("item_type.label_active").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.             
                     _createRadio('active',@$item_type['active'])
                .'</div>
            </div>'
        : '' !!}
        
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!!  _createButtonSubmit() !!}
                {!!  _createButtonReset() !!}
                {!! _createButtonBack('item_types') !!}              
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
 * File Create : 2018-04-28 18:19:08 *
 */
-->