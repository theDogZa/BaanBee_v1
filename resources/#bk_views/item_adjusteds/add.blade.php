@extends('layouts.app')
@section('title')
{{ ucfirst(__('item_adjusted.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
    <div class="x_title">
        <h2>
            {!! config('core.icon.title_from') !!}
            {!! (!isset($item_adjusted))?
                ucfirst(__('item_adjusted.head_from_add'))  :  ucfirst(__('item_adjusted.head_from_edit'))
            !!}
        </h2>
        @include('partials._panel_toolbox')
        <div class="clearfix"></div>
    </div>
    <!--/.x_title -->
  <div class="x_content">
    <form action="{{ url('/item_adjusteds'.( isset($item_adjusted) ? "/" . $item_adjusted->id : "")) }}" method="POST" class="form-horizontal form-process" id="form" >
        <div class="row">     
            {{ csrf_field() }}      
         
            @if(isset($item_adjusted))                
                {{ Form::hidden('_method','PATCH') }}
            @endif  


        {!! (!empty( $arrShowFieldFrom['doc_num'] ))?       
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('doc_num', __("item_adjusted.label_doc_num").' *', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.
                    Form::text('doc_num', @$item_adjusted['doc_num'], 
                    array('placeholder'=>__("item_adjusted.placeholder_doc_num"),'class' => 'form-control','id' => 'doc_num' ,'required','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_adjusted.label_doc_num")]) ))                
                .'</div>
            </div>'
        : '' !!} 
  
        {!! (!empty( $arrShowFieldFrom['date'] ))?
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('date', __("item_adjusted.label_date").' *', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">
                    <div class="input-group date datetimepicker"  data-date-format="'. config('core.date-format-js').' " data-link-field = "date"
                        data-link-format = "yyyy-mm-dd" data-min-view = "2" data-date-autoclose = "true" data-date-today-btn = "true"  >                       
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>'.
                        Form::text('',_datetime(@$item_adjusted['date'],2), array('placeholder'=>__("item_adjusted.placeholder_date"),'class' => 'form-control','data-inputmask'=> "'mask': 'd/m/y'",'required','data-parsley-errors-container'=>'#errors-messages-box-date' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_adjusted.label_date")]) ))                             
                        .'<span class="input-group-addon">
                            <span class="glyphicon glyphicon-remove"></span>
                        </span>
                    </div>
                    <span id="errors-messages-box-date"></span>'.
                    Form::hidden('date',@$item_adjusted['date'], array('id' => 'date'))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['adjusted_desc'] ))?
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('adjusted_desc', __("item_adjusted.label_adjusted_desc").' ', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.               
                Form::textarea('adjusted_desc', @$item_adjusted['adjusted_desc'], array('rows'=> config("core.layout.input.textarea.rows"),'placeholder'=>__("item_adjusted.placeholder_adjusted_desc"),'class' => 'form-control text-editor','','', 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_adjusted.label_adjusted_desc")]) ))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['adjusted_status'] ))?     
            '<div class="'.config('core.layout.form.add.box').'">'.
                 Form::label('adjusted_status', __("item_adjusted.label_adjusted_status").' ', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.              
                 _createInputRadio('adjusted_status',@$item_adjusted['adjusted_status'],@$arradjusted_status)
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['active'] ))?
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('active', __("item_adjusted.label_active").' ', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.             
                     _createRadio('active',@$item_adjusted['active'])
                .'</div>
            </div>'
        : '' !!}
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="{!! config('core.layout.form.add.button') !!}">
                {!!  _createButtonSubmit() !!}
                {!!  _createButtonReset() !!}
                {!! _createButtonBack('item_adjusteds') !!}              
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
 * Latest Update : 24/07/2018 23:00
 * Version : ver.1.00.00
 *
 * File Create : 2018-07-25 00:17:45 *
 */
-->