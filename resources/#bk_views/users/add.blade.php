@extends('layouts.app')
@section('title')
{{ ucfirst(__('user.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2>
    {!! config('core.icon.title_from') !!}
    {!! (!isset($user))?
        ucfirst(__('user.head_from_add'))  :  ucfirst(__('user.head_from_edit'))
    !!}
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
    <form action="{{ url('/users'.( isset($user) ? "/" . $user->id : "")) }}" method="POST" class="form-horizontal form-process" id="form" >
            {{ csrf_field() }}      
         
            @if(isset($user))                
                {{ Form::hidden('_method','PATCH') }}
            @endif  


        {!! (!empty( $arrShowFieldFrom['name'] ))?       
            '<div class="form-group">'.
                Form::label('name', __("user.label_name").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('name', @$user['name'], 
                    array('placeholder'=>__("user.placeholder_name"),'class' => 'form-control','id' => 'name' ,'required','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("user.label_name")]) ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['username'] ))?       
            '<div class="form-group">'.
                Form::label('username', __("user.label_username").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('username', @$user['username'], 
                    array('placeholder'=>__("user.placeholder_username"),'class' => 'form-control','id' => 'username' ,'required', 
                    'data-parsley-required-message' =>  __("validation.required", ['attribute' => __("user.label_username")]),
                    'data-parsley-remote'=>url("/checkUsername/".@$user['id']),
                    'data-parsley-remote-reverse'=> 'true',
                    'data-parsley-remote-message'=>  __("validation.unique", ['attribute' => __("user.label_username")]),
                    ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['email'] ))?       
            '<div class="form-group">'.
                Form::label('email', __("user.label_email").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('email', @$user['email'], 
                    array('placeholder'=>__("user.placeholder_email"),'class' => 'form-control','id' => 'email' ,'required',
                    'data-parsley-required-message' =>  __("validation.required", ['attribute' => __("user.label_email")]),
                    'data-parsley-remote'=>url("/checkEmail/".@$user['id']),
                    'data-parsley-remote-reverse'=> 'true',
                    'data-parsley-remote-message'=>  __("validation.unique", ['attribute' => __("user.label_email")]),
                    ))                
                .'</div>
            </div>'
        : '' !!} 

         @if(isset($user))   
        {!! (!empty( $arrShowFieldFrom['password'] ))?       
            '<div class="form-group">'.
                Form::label('password', __("user.label_password"), array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                   Form::password('new_password', 
                    array('placeholder'=>__("user.placeholder_password"),'class' => 'form-control','id' => 'new_password' ,
                    'data-parsley-minlength'=>'6',
                    'data-parsley-minlength-message'=>  __("validation.min.string", ['attribute' => __("user.label_password") ,'min' => 6]),
                    'data-parsley-required-message'=>  __("validation.required", ['attribute' => __("user.label_password")])  ))             
                .'</div>
            </div>'
        : '' !!} 
        {!! (!empty( $arrShowFieldFrom['password'] ))?       
            '<div class="form-group">'.
                Form::label('password', __("user.label_confirm_password") , array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                   Form::password('confirm_password', 
                    array('placeholder'=>__("user.placeholder_password"),'class' => 'form-control','id' => 'confirm_password' ,
                    'data-parsley-minlength'=>'6',
                    'data-parsley-minlength-message'=>  __("validation.min.string", ['attribute' => __("profile.label_confirm_password") ,'min' => 6]),
                    'data-parsley-required-message'=>  __("validation.required", ['attribute' => __("user.label_confirm_password")]),
                    'data-parsley-equalto'=>"#new_password",
                    'data-parsley-equalto-message'=>  __("validation.same", ['attribute' => __("user.label_confirm_password"),'other'=>__("user.label_new_password")])
                    ))             
                .'</div>
            </div>'
        : '' !!} 
         @else
        {!! (!empty( $arrShowFieldFrom['password'] ))?       
            '<div class="form-group">'.
                Form::label('password', __("user.label_password").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                   Form::password('new_password', 
                    array('placeholder'=>__("user.placeholder_password"),'class' => 'form-control','id' => 'new_password' ,'required',
                    'data-parsley-minlength'=>'6',
                    'data-parsley-minlength-message'=>  __("validation.min.string", ['attribute' => __("user.label_password") ,'min' => 6]),
                    'data-parsley-required-message'=>  __("validation.required", ['attribute' => __("user.label_password")])  ))             
                .'</div>
            </div>'
        : '' !!} 
        {!! (!empty( $arrShowFieldFrom['password'] ))?       
            '<div class="form-group">'.
                Form::label('password', __("user.label_confirm_password").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                   Form::password('confirm_password', 
                    array('placeholder'=>__("user.placeholder_password"),'class' => 'form-control','id' => 'confirm_password' ,'required',
                    'data-parsley-minlength'=>'6',
                    'data-parsley-minlength-message'=>  __("validation.min.string", ['attribute' => __("profile.label_confirm_password") ,'min' => 6]),
                    'data-parsley-required-message'=>  __("validation.required", ['attribute' => __("user.label_confirm_password")]),
                    'data-parsley-equalto'=>"#new_password",
                    'data-parsley-equalto-message'=>  __("validation.same", ['attribute' => __("user.label_confirm_password"),'other'=>__("user.label_new_password")])
                    ))             
                .'</div>
            </div>'
        : '' !!} 
        @endif

        {!! (!empty( $arrShowFieldFrom['remember_token'] ))?       
            '<div class="form-group">'.
                Form::label('remember_token', __("user.label_remember_token").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('remember_token', @$user['remember_token'], 
                    array('placeholder'=>__("user.placeholder_remember_token"),'class' => 'form-control','id' => 'remember_token' ,'','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("user.label_remember_token")]) ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['online'] ))?     
            '<div class="form-group">'.
                 Form::label('online', __("user.label_online").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.              
                 _createInputRadio('online',@$user['online'],@$arronline)
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['active'] ))?
            '<div class="form-group">'.
                Form::label('active', __("user.label_active").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.             
                     _createRadio('active',@$user['active'])
                .'</div>
            </div>'
        : '' !!}
        
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!!  _createButtonSubmit() !!}
                {!!  _createButtonReset() !!}
                {!! _createButtonBack('users') !!}              
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
 * Latest Update : 15/04/2018 03:21
 * Version : ver.1.00.00
 *
 * File Create : 2018-04-15 00:04:43 *
 */
-->