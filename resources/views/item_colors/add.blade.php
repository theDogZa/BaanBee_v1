@extends('layouts.app')
@section('title')
{{ ucfirst(__('item_color.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2>
    {!! config('core.icon.title_from') !!}
    {!! (!isset($item_color))?
        ucfirst(__('item_color.head_from_add'))  :  ucfirst(__('item_color.head_from_edit'))
    !!}
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
    <form action="{{ url('/item_colors'.( isset($item_color) ? "/" . $item_color->id : "")) }}" method="POST" class="form-horizontal form-process" id="form" >
            {{ csrf_field() }}      
         
            @if(isset($item_color))                
                {{ Form::hidden('_method','PATCH') }}
            @endif  


        {!! (!empty( $arrShowFieldFrom['color_name'] ))?       
            '<div class="form-group">'.
                Form::label('color_name', __("item_color.label_color_name").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('color_name', @$item_color['color_name'], 
                    array('placeholder'=>__("item_color.placeholder_color_name"),'class' => 'form-control','id' => 'color_name' ,'required','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_color.label_color_name")]) ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['color_code'] ))?       
            '<div class="form-group">'.
                Form::label('color_code', __("item_color.label_color_code").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('color_code', @$item_color['color_code'], 
                    array('placeholder'=>__("item_color.placeholder_color_code"),'class' => 'form-control','id' => 'color_code' ,'required' ,
                    'data-parsley-required-message' =>  __("validation.required", ['attribute' => __("item_color.label_color_code")]),
                    'data-parsley-remote'=>url("/item_colors/checkCode/".@$item_color['id']),
                    'data-parsley-remote-reverse'=> 'true',
                    'data-parsley-remote-message'=>  __("validation.unique", ['attribute' => __("item_color.label_color_code")]),  
                    ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['color_desc'] ))?
            '<div class="form-group">'.
                Form::label('color_desc', __("item_color.label_color_desc").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.               
                Form::textarea('color_desc', @$item_color['color_desc'], array('placeholder'=>__("item_color.placeholder_color_desc"),'class' => 'form-control text-editor','','', 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_color.label_color_desc")]) ))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['active'] ))?
            '<div class="form-group">'.
                Form::label('active', __("item_color.label_active").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.             
                     _createRadio('active',@$item_color['active'])
                .'</div>
            </div>'
        : '' !!}
        
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!!  _createButtonSubmit() !!}
                {!!  _createButtonReset() !!}
                {!! _createButtonBack('item_colors') !!}              
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
 * File Create : 2018-04-28 18:18:57 *
 */
-->