@extends('layouts.app')
@section('title')
{{ ucfirst(__('[[model_singular]].head_title')) }} 
@stop

@section('content')

<div class="x_panel">
    <div class="x_title">
        <h2>
            {!! config('core.icon.title_from') !!}
            {!! (!isset($[[model_singular]]))?
                ucfirst(__('[[model_singular]].head_from_add'))  :  ucfirst(__('[[model_singular]].head_from_edit'))
            !!}
        </h2>
        @include('partials._panel_toolbox')
        <div class="clearfix"></div>
    </div>
    <!--/.x_title -->
  <div class="x_content">
    <form action="{{ url('/[[route_path]]'.( isset($[[model_singular]]) ? "/" . $[[model_singular]]->id : "")) }}" method="POST" class="form-horizontal form-process" id="form" >
        <div class="row">     
            {{ csrf_field() }}      
         
            @if(isset($[[model_singular]]))                
                {{ Form::hidden('_method','PATCH') }}
            @endif  

[[foreach:columns_index]]
[[if:i.type=='select']]

        {!! (!empty( $arrShowFieldFrom['[[i.name]]'] ))?       
            '<div class="'.config('core.layout.form.add.box').'">'.               
                Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]").' [[i.display_required]]', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.
                    Form::select('[[i.name]]',['' => '']+$[[i.model_select]], @$[[model_singular]]['[[i.name]]'] , array('placeholder'=>__("[[model_singular]].placeholder_[[i.name]]"),'class' => 'select2_single form-control','[[i.required]]','[[i.readonly]]','data-parsley-errors-container'=>'#errors-messages-box-[[i.name]]' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("[[model_singular]].label_[[i.name]]")]) ))
                    .'<span id="errors-messages-box-[[i.name]]"></span>
                </div>
            </div>'
        : '' !!}
[[endif]]
[[if:i.type=='text']]

        {!! (!empty( $arrShowFieldFrom['[[i.name]]'] ))?       
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]").' [[i.display_required]]', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.
                    Form::text('[[i.name]]', @$[[model_singular]]['[[i.name]]'], 
                    array('placeholder'=>__("[[model_singular]].placeholder_[[i.name]]"),'class' => 'form-control','id' => '[[i.name]]' ,'[[i.required]]','[[i.readonly]]' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("[[model_singular]].label_[[i.name]]")]) ))                
                .'</div>
            </div>'
        : '' !!} 
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type=='number']]

        {!! (!empty( $arrShowFieldFrom['[[i.name]]'] ))?       
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]").' [[i.display_required]]', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.
                    Form::number('[[i.name]]',@$[[model_singular]]['[[i.name]]'], array('placeholder'=>__("[[model_singular]].placeholder_[[i.name]]"),'class' => 'form-control', 'id' => '[[i.name]]','step'=>'0.0001','[[i.required]]','[[i.readonly]]' ,  'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("[[model_singular]].label_[[i.name]]")]) ))
                .'</div>
            </div>'
        : '' !!} 
[[endif]]
[[if:i.type=='textarea']]

        {!! (!empty( $arrShowFieldFrom['[[i.name]]'] ))?
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]").' [[i.display_required]]', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.               
                Form::textarea('[[i.name]]', @$[[model_singular]]['[[i.name]]'], array('rows'=> config("core.layout.input.textarea.rows"),'placeholder'=>__("[[model_singular]].placeholder_[[i.name]]"),'class' => 'form-control text-editor','[[i.required]]','[[i.readonly]]', 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("[[model_singular]].label_[[i.name]]")]) ))
                .'</div>
            </div>'
        : '' !!}
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type=='datetime']]

        {!! (!empty( $arrShowFieldFrom['[[i.name]]'] ))?
            '<div class="'.config('core.layout.form.add.box').'">'.
                 Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]").' [[i.display_required]]', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">
                    <div class="input-group date datetimepicker" data-date-format="'.config('core.datetime-format-js').' " data-link-field = "[[i.name]]"
                        data-link-format = "yyyy-mm-dd hh:ii" data-date-autoclose="true" data-date-today-btn="true" >
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>'.
                        Form::text('',_datetime(@$[[model_singular]]['[[i.name]]'],1), array('placeholder'=>__("[[model_singular]].placeholder_[[i.name]]"),'class' => 'form-control','data-inputmask'=> "'mask': 'd/m/y h:s'",'[[i.required]]','data-parsley-errors-container'=>'#errors-messages-box-[[i.name]]' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("[[model_singular]].label_[[i.name]]")]) ))      
                        .'<span class="input-group-addon">
                            <span class="glyphicon glyphicon-remove"></span>
                        </span>
                    </div>
                    <span id="errors-messages-box-[[i.name]]"></span>'.
                    Form::hidden('[[i.name]]',@$[[model_singular]]['[[i.name]]'], array('id' => '[[i.name]]'))
                .'</div>
            </div>'
        : '' !!}
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type=='date']]

        {!! (!empty( $arrShowFieldFrom['[[i.name]]'] ))?
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]").' [[i.display_required]]', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">
                    <div class="input-group date datetimepicker"  data-date-format="'. config('core.date-format-js').' " data-link-field = "[[i.name]]"
                        data-link-format = "yyyy-mm-dd" data-min-view = "2" data-date-autoclose = "true" data-date-today-btn = "true"  >                       
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>'.
                        Form::text('',_datetime(@$[[model_singular]]['[[i.name]]'],2), array('placeholder'=>__("[[model_singular]].placeholder_[[i.name]]"),'class' => 'form-control','data-inputmask'=> "'mask': 'd/m/y'",'[[i.required]]','data-parsley-errors-container'=>'#errors-messages-box-[[i.name]]' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("[[model_singular]].label_[[i.name]]")]) ))                             
                        .'<span class="input-group-addon">
                            <span class="glyphicon glyphicon-remove"></span>
                        </span>
                    </div>
                    <span id="errors-messages-box-[[i.name]]"></span>'.
                    Form::hidden('[[i.name]]',@$[[model_singular]]['[[i.name]]'], array('id' => '[[i.name]]'))
                .'</div>
            </div>'
        : '' !!}
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type=='time']]

        {!! (!empty( $arrShowFieldFrom['[[i.name]]'] ))?
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]").' [[i.display_required]]', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">
                    <div class="input-group date datetimepicker" data-date-format="'.config('core.time-format-js').'" data-link-field = "[[i.name]]"
                        data-link-format = "hh:ii" data-max-view = "0" data-start-view = "0" data-date-autoclose = "true" data-date-today-btn = "true"  >                      
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>'.
                        Form::text('',_datetime(@$[[model_singular]]['[[i.name]]'],3), array('placeholder'=>__("[[model_singular]].placeholder_[[i.name]]"),'data-inputmask'=> "'mask': 'h:s'",'class' => 'form-control','[[i.required]]','data-parsley-errors-container'=>'#errors-messages-box-[[i.name]]' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("[[model_singular]].label_[[i.name]]")]) ))                             
                        .'<span class="input-group-addon">
                            <span class="glyphicon glyphicon-remove"></span>
                        </span>
                    </div>
                    <span id="errors-messages-box-[[i.name]]"></span>'.
                    Form::hidden('[[i.name]]',@$[[model_singular]]['[[i.name]]'], array('id' => '[[i.name]]')) 
               .'</div>
            </div>'
        : '' !!}
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type=='radio']]

        {!! (!empty( $arrShowFieldFrom['[[i.name]]'] ))?     
            '<div class="'.config('core.layout.form.add.box').'">'.
                 Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]").' [[i.display_required]]', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.              
                 _createInputRadio('[[i.name]]',@$[[model_singular]]['[[i.name]]'],@$arr[[i.name]])
                .'</div>
            </div>'
        : '' !!}
[[endif]]
[[if:i.type=='radio_active']]

        {!! (!empty( $arrShowFieldFrom['[[i.name]]'] ))?
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]").' [[i.display_required]]', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.             
                     _createRadio('[[i.name]]',@$[[model_singular]]['[[i.name]]'])
                .'</div>
            </div>'
        : '' !!}
[[endif]]
[[if:i.type=='unknown']]

        {!! (!empty( $arrShowFieldFrom['[[i.name]]'] ))?
            '<div class="'.config('core.layout.form.add.box').'">'.
                Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]").' [[i.display_required]]', array('class' => config("core.layout.form.add.label")))
                .'<div class="'.config('core.layout.form.add.input').'">'.              
                    Form::text('[[i.name]]',@$[[model_singular]]['[[i.name]]'], array('placeholder'=>__("[[model_singular]].placeholder_[[i.name]]"),'class' => 'form-control','id' => '[[i.name]]' ,'[[i.required]]','[[i.readonly]]' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("[[model_singular]].label_[[i.name]]")]) )) 
                .'</div>
            </div>'
        : '' !!}
[[endif]]
[[endforeach]]
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="{!! config('core.layout.form.add.button') !!}">
                {!!  _createButtonSubmit() !!}
                {!!  _createButtonReset() !!}
                {!! _createButtonBack('[[route_path]]') !!}              
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
[[if:columns_type_datetime=='true']]
<script src="{{asset('vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
<link href="{{asset('vendors/datetimepicker/bootstrap-datetimepicker.css')}}" rel="stylesheet">
<script src="{{asset('vendors/datetimepicker/bootstrap-datetimepicker.js')}}"></script>
<script src="{{asset('vendors/datetimepicker/locales/bootstrap-datepicker.th.min.js')}}"></script>
[[endif]]
[[if:columns_type_select=='true']]
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet">
<script src="{{asset('vendors/select2/js/select2.full.min.js')}}"></script>
[[endif]]
[[if:columns_type_textarea=='true']]

[[endif]]
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
[[if:columns_type_select=='true']]
    $('.select2_single').select2({
        placeholder: '{{ __("core.placeholder_select") }}',
        allowClear: true
    }).on('change', function() {       
       $(this).parsley().validate();  
    });
[[endif]]
[[if:columns_type_datetime=='true']]

    $('.datetimepicker').datetimepicker().on('change', function() {       
       $(this).find('input').parsley().validate();   
    });

    $(":input").inputmask();
[[endif]]
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
 * File Create : [[datetimenow]]
 *
 */
-->