@extends('layouts.app')
@section('title')
{{ ucfirst(__('example.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
    <div class="x_title">
        <h2>
            {!! config('core.icon.title_from') !!}
            {!! (!isset($example))?
                ucfirst(__('example.head_from_add'))  :  ucfirst(__('example.head_from_edit'))
            !!}
        </h2>
        @include('partials._panel_toolbox')
        <div class="clearfix"></div>
    </div>
    <!--/.x_title -->
  <div class="x_content">
    <form action="{{ url('/examples'.( isset($example) ? "/" . $example->id : "")) }}" method="POST" class="form-horizontal form-process" id="form" >
        <div class="row">     
            {{ csrf_field() }}      
         
            @if(isset($example))                
                {{ Form::hidden('_method','PATCH') }}
            @endif  


        {!! (!empty( $arrShowFieldFrom['parent_id'] ))?       
            '<div class="'.config('core.layout.form.add.box').'">'.               
                Form::label('parent_id', __("example.label_parent_id").' ', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.
                    Form::select('parent_id',['' => '']+$Example, @$example['parent_id'] , array('placeholder'=>__("example.placeholder_parent_id"),'class' => 'select2_single form-control','','','data-parsley-errors-container'=>'#errors-messages-box-parent_id' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("example.label_parent_id")]) ))
                    .'<span id="errors-messages-box-parent_id"></span>
                </div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['users_id'] ))?       
            '<div class="'.config('core.layout.form.add.box').'">'.               
                Form::label('users_id', __("example.label_users_id").' *', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.
                    Form::select('users_id',['' => '']+$Userss, @$example['users_id'] , array('placeholder'=>__("example.placeholder_users_id"),'class' => 'select2_single form-control','required','','data-parsley-errors-container'=>'#errors-messages-box-users_id' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("example.label_users_id")]) ))
                    .'<span id="errors-messages-box-users_id"></span>
                </div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['title'] ))?       
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('title', __("example.label_title").' *', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.
                    Form::text('title', @$example['title'], 
                    array('placeholder'=>__("example.placeholder_title"),'class' => 'form-control','id' => 'title' ,'required','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("example.label_title")]) ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['body'] ))?
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('body', __("example.label_body").' *', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.               
                Form::textarea('body', @$example['body'], array('rows'=> config("core.layout.input.textarea.rows"),'placeholder'=>__("example.placeholder_body"),'class' => 'form-control text-editor','required','', 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("example.label_body")]) ))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['amount'] ))?       
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('amount', __("example.label_amount").' *', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.
                    Form::number('amount',@$example['amount'], array('placeholder'=>__("example.placeholder_amount"),'class' => 'form-control', 'id' => 'amount','step'=>'0.0001','required','' ,  'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("example.label_amount")]) ))
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['datetime'] ))?
            '<div class="'.config('core.layout.form.add.box').'">'.
                 Form::label('datetime', __("example.label_datetime").' *', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">
                    <div class="input-group date datetimepicker" data-date-format="'.config('core.datetime-format-js').' " data-link-field = "datetime"
                        data-link-format = "yyyy-mm-dd hh:ii" data-date-autoclose="true" data-date-today-btn="true" >
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>'.
                        Form::text('',_datetime(@$example['datetime'],1), array('placeholder'=>__("example.placeholder_datetime"),'class' => 'form-control','data-inputmask'=> "'mask': 'd/m/y h:s'",'required','data-parsley-errors-container'=>'#errors-messages-box-datetime' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("example.label_datetime")]) ))      
                        .'<span class="input-group-addon">
                            <span class="glyphicon glyphicon-remove"></span>
                        </span>
                    </div>
                    <span id="errors-messages-box-datetime"></span>'.
                    Form::hidden('datetime',@$example['datetime'], array('id' => 'datetime'))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['date'] ))?
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('date', __("example.label_date").' ', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">
                    <div class="input-group date datetimepicker"  data-date-format="'. config('core.date-format-js').' " data-link-field = "date"
                        data-link-format = "yyyy-mm-dd" data-min-view = "2" data-date-autoclose = "true" data-date-today-btn = "true"  >                       
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>'.
                        Form::text('',_datetime(@$example['date'],2), array('placeholder'=>__("example.placeholder_date"),'class' => 'form-control','data-inputmask'=> "'mask': 'd/m/y'",'','data-parsley-errors-container'=>'#errors-messages-box-date' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("example.label_date")]) ))                             
                        .'<span class="input-group-addon">
                            <span class="glyphicon glyphicon-remove"></span>
                        </span>
                    </div>
                    <span id="errors-messages-box-date"></span>'.
                    Form::hidden('date',@$example['date'], array('id' => 'date'))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['time'] ))?
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('time', __("example.label_time").' ', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">
                    <div class="input-group date datetimepicker" data-date-format="'.config('core.time-format-js').'" data-link-field = "time"
                        data-link-format = "hh:ii" data-max-view = "0" data-start-view = "0" data-date-autoclose = "true" data-date-today-btn = "true"  >                      
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>'.
                        Form::text('',_datetime(@$example['time'],3), array('placeholder'=>__("example.placeholder_time"),'data-inputmask'=> "'mask': 'h:s'",'class' => 'form-control','','data-parsley-errors-container'=>'#errors-messages-box-time' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("example.label_time")]) ))                             
                        .'<span class="input-group-addon">
                            <span class="glyphicon glyphicon-remove"></span>
                        </span>
                    </div>
                    <span id="errors-messages-box-time"></span>'.
                    Form::hidden('time',@$example['time'], array('id' => 'time')) 
               .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['status'] ))?     
            '<div class="'.config('core.layout.form.add.box').'">'.
                 Form::label('status', __("example.label_status").' ', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.              
                 _createInputRadio('status',@$example['status'],@$arrstatus)
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['active'] ))?
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('active', __("example.label_active").' *', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.             
                     _createRadio('active',@$example['active'])
                .'</div>
            </div>'
        : '' !!}
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="{!! config('core.layout.form.add.button') !!}">
                {!!  _createButtonSubmit() !!}
                {!!  _createButtonReset() !!}
                {!! _createButtonBack('examples') !!}              
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
 * Latest Update : 24/07/2018 23:00
 * Version : ver.1.00.00
 *
 * File Create : 2019-11-29 18:09:18 *
 */
-->