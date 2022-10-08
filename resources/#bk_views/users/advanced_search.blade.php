<div class="x_panel panel_hide" id="panel_advanced_search">
    <div class="x_title">
        <h2>{!! config('core.icon.title_advanced_search') !!}  {{ ucfirst(__('core.title advanced search')) }} </h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
{!! Form::open(['url' => Request::path(),'method'=>'GET','class'=>'form-label-left input_mask form-process','id'=>'from-advanced-search']) !!}
<div class="row">


        {!! (!empty( $arrShowField['name'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('name', __('user.th_name'), array('class' => 'control-label'))
                . Form::text('name', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'name' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['username'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('username', __('user.th_username'), array('class' => 'control-label'))
                . Form::text('username', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'username' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['email'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('email', __('user.th_email'), array('class' => 'control-label'))
                . Form::text('email', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'email' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['password'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('password', __('user.th_password'), array('class' => 'control-label'))
                . Form::text('password', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'password' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['remember_token'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('remember_token', __('user.th_remember_token'), array('class' => 'control-label'))
                . Form::text('remember_token', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'remember_token' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['online'] ))?     
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('online', __('user.th_online'), array('class' => 'control-label'))
            .'<div>'.
                 _createInputChoiceSearch('online',@$request['online'],@$arronline)
            .'</div>
        </div>'
        : '' !!}

        {!! (!empty( $arrShowField['active'] ))?
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('active', __('user.th_active'), array('class' => 'control-label'))
                .'<div>'.
                  _createInputChoiceSearch('active',@$request['active'])
                .'</div>
            </div>'
        : '' !!}
    <div class="clearfix"></div>
</div>      
<div class="ln_solid"></div>
<div class="form-group pull-right" style="height: 20px;">
  
    {!! _createButtonSearch('',array('type'=>'submit','id'=>'btn-advanced-search')) !!}
    {!! _createButtonReset() !!}    
</div>
{!! Form::close() !!}
    </div>
    <div class="clearfix"></div>
</div>
@section('scripts')

<script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>
<link href="{{asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">

<script src="{{asset('vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
<link href="{{asset('vendors/datetimepicker/bootstrap-datetimepicker.css')}}" rel="stylesheet">
<script src="{{asset('vendors/datetimepicker/bootstrap-datetimepicker.js')}}"></script>
<script src="{{asset('vendors/datetimepicker/locales/bootstrap-datepicker.th.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() { 
    $('.datetimepicker').datetimepicker();
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
 * Latest Update : 06/04/2018 13:51
 * Version : ver.1.00.00
 *
 * File Create : 2018-04-15 00:04:43 *
 */
-->