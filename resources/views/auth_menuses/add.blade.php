@extends('layouts.app')
@section('title')
{{ ucfirst(__('auth_menu.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2>
    {!! config('core.icon.title_from') !!}
    {!! (!isset($auth_menu))?
        ucfirst(__('auth_menu.head_from_add'))  :  ucfirst(__('auth_menu.head_from_edit'))
    !!}
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
    <form action="{{ url('/auth_menuses'.( isset($auth_menu) ? "/" . $auth_menu->id : "")) }}" method="POST" class="form-horizontal form-process" id="form" >
            {{ csrf_field() }}      
         
            @if(isset($auth_menu))                
                {{ Form::hidden('_method','PATCH') }}
            @endif  


        {!! (!empty( $arrShowFieldFrom['parent_id'] ))?       
            '<div class="form-group">'.               
                Form::label('parent_id', __("auth_menu.label_parent_id").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::select('parent_id',['' => '']+$Auth_menu, @$auth_menu['parent_id'] , array('placeholder'=>__("auth_menu.placeholder_parent_id"),'class' => 'select2_single form-control','','','data-parsley-errors-container'=>'#errors-messages-box-parent_id' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("auth_menu.label_parent_id")]) ))
                    .'<span id="errors-messages-box-parent_id"></span>
                </div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['menu_name'] ))?       
            '<div class="form-group">'.
                Form::label('menu_name', __("auth_menu.label_menu_name").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('menu_name', @$auth_menu['menu_name'], 
                    array('placeholder'=>__("auth_menu.placeholder_menu_name"),'class' => 'form-control','id' => 'menu_name' ,'required','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("auth_menu.label_menu_name")]) ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['menu_link'] ))?       
            '<div class="form-group">'.
                Form::label('menu_link', __("auth_menu.label_menu_link").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('menu_link', @$auth_menu['menu_link'], 
                    array('placeholder'=>__("auth_menu.placeholder_menu_link"),'class' => 'form-control','id' => 'menu_link' ,'required','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("auth_menu.label_menu_link")]) ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['menu_icon'] ))?       
            '<div class="form-group">'.
                Form::label('menu_icon', __("auth_menu.label_menu_icon").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('menu_icon', @$auth_menu['menu_icon'], 
                    array('placeholder'=>__("auth_menu.placeholder_menu_icon"),'class' => 'form-control','id' => 'menu_icon' ,'','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("auth_menu.label_menu_icon")]) ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['groups'] ))?       
            '<div class="form-group">'.
                Form::label('groups', __("auth_menu.label_groups").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::number('groups',@$auth_menu['groups'], array('placeholder'=>__("auth_menu.placeholder_groups"),'class' => 'form-control', 'id' => 'groups','step'=>'0.0001','','' ,  'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("auth_menu.label_groups")]) ))
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['menu_sort'] ))?       
            '<div class="form-group">'.
                Form::label('menu_sort', __("auth_menu.label_menu_sort").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::number('menu_sort',@$auth_menu['menu_sort'], array('placeholder'=>__("auth_menu.placeholder_menu_sort"),'class' => 'form-control', 'id' => 'menu_sort','step'=>'0.0001','','' ,  'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("auth_menu.label_menu_sort")]) ))
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['active'] ))?
            '<div class="form-group">'.
                Form::label('active', __("auth_menu.label_active").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.             
                     _createRadio('active',@$auth_menu['active'])
                .'</div>
            </div>'
        : '' !!}
        
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!!  _createButtonSubmit() !!}
                {!!  _createButtonReset() !!}
                {!! _createButtonBack('auth_menuses') !!}              
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
 * File Create : 2018-04-17 22:48:07 *
 */
-->