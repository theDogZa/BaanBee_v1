@extends('layouts.app')
@section('title')
{{ ucfirst(__('profile.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2>
    {!! config('core.icon.title_from') !!}
    {!! 
        ucfirst(__('profile.head_from_change_password'))  
    !!}
    </h2>
     <!-- @include('partials._panel_toolbox')-->
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">

    <form action="{{ url('updatePassword') }}" method="POST" class="form-horizontal" id="form-change-password" >
            {{ csrf_field() }}      
       
            <div class="form-group">
            {{   Form::label('old_password', __("profile.label_cur_password").' *', array('class' => 'col-sm-3 control-label')) }} 
                <div class="col-sm-6">
            {{      Form::password('cur_password', 
                    array('placeholder'=>__("profile.placeholder_password"),'class' => 'form-control','id' => 'cur_password' ,'required',
                    'data-parsley-minlength'=>'6',
                    'data-parsley-minlength-message'=>  __("validation.min.string", ['attribute' => __("profile.label_cur_password") ,'min' => 6]),
                    'data-parsley-required-message'=>  __("validation.required", ['attribute' => __("profile.label_cur_password")]),
                    'data-parsley-remote'=>url("/checkPassword"),
                    'data-parsley-remote-reverse'=> 'true',
                    'data-parsley-remote-message'=>  __("validation.confirmed", ['attribute' => __("profile.label_cur_password")]),
                    )) }}                
                </div>
            </div>

            <div class="form-group">
            {{   Form::label('new_password', __("profile.label_new_password").' *', array('class' => 'col-sm-3 control-label')) }} 
                <div class="col-sm-6">
            {{      Form::password('new_password', 
                    array('placeholder'=>__("profile.placeholder_password"),'class' => 'form-control','id' => 'new_password' ,'required',
                    'data-parsley-minlength'=>'6',
                    'data-parsley-minlength-message'=>  __("validation.min.string", ['attribute' => __("profile.label_new_password") ,'min' => 6]),
                    'data-parsley-required-message'=>  __("validation.required", ['attribute' => __("profile.label_new_password")])
                   
                    )) }}             
                </div>
            </div>

            <div class="form-group">
            {{    Form::label('confirm_password', __("profile.label_confirm_password").' *', array('class' => 'col-sm-3 control-label')) }} 
                <div class="col-sm-6">
            {{      Form::password('confirm_password', 
                    array('placeholder'=>__("profile.placeholder_password"),'class' => 'form-control','id' => 'confirm_password' ,'required',
                    'data-parsley-minlength'=>'6',
                    'data-parsley-minlength-message'=>  __("validation.min.string", ['attribute' => __("profile.label_confirm_password") ,'min' => 6]),
                    'data-parsley-required-message'=>  __("validation.required", ['attribute' => __("profile.label_confirm_password")]),
                    'data-parsley-equalto'=>"#new_password",
                    'data-parsley-equalto-message'=>  __("validation.same", ['attribute' => __("profile.label_confirm_password"),'other'=>__("profile.label_new_password")])
                    )) }}        
                </div>
            </div>
   
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!!  _createButtonSubmit() !!}
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
<script type="text/javascript">
$_form = '#form-change-password';
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
});

$(function () {
  
   $('#form-change-password').submit(function (e) {

       var message = '{{ __("core.confirm_change_password") }}'
       var title = '{{ __("core.confirm_title") }}';
       var form = this;
        e.preventDefault();
        $('#form-change-password').parsley().validate();
        var chkValid = $('#form-change-password').parsley().isValid();
        if (chkValid === null){                
            var Confirm = ConfirmYesNo(title, message);
            Confirm.then(function (result) {
                if (result) {                                   
                    setTimeout(function () {
                        form.submit();        
                    }, 2500);
                    ProcessingDialog.show('Processing...');
                }
            });
        }   
    });
});

</script>
@endsection



<!--
/** 
 * 
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 11/04/2018 22:43
 * Version : v.10000
 */
-->
