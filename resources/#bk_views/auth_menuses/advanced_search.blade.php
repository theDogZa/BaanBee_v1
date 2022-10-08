<div class="x_panel panel_hide" id="panel_advanced_search">
    <div class="x_title">
        <h2>{!! config('core.icon.title_advanced_search') !!}  {{ ucfirst(__('core.title advanced search')) }} </h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
{!! Form::open(['url' => Request::path(),'method'=>'GET','class'=>'form-label-left input_mask form-process','id'=>'from-advanced-search']) !!}
<div class="row">


        {!! (!empty( $arrShowField['parent_id'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.       
                Form::label('parent_id', __('auth_menu.th_parent_id'), array('class' => 'control-label'))
                .'<div>'.
                Form::select('parent_id',['' => '']+$Auth_menu, '' , array('class' => 'select2_single form-control'))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowField['menu_name'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('menu_name', __('auth_menu.th_menu_name'), array('class' => 'control-label'))
                . Form::text('menu_name', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'menu_name' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['menu_link'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('menu_link', __('auth_menu.th_menu_link'), array('class' => 'control-label'))
                . Form::text('menu_link', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'menu_link' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['menu_icon'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('menu_icon', __('auth_menu.th_menu_icon'), array('class' => 'control-label'))
                . Form::text('menu_icon', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'menu_icon' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['groups'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">
                <div class="row">'.
                        Form::label('groups', __('auth_menu.th_groups'), array('class' => 'control-label col-xs-12'))
                .'</div>
                <div class="col-xs-12 search-number" >
                    <div class="input-group">'.
                        Form::number('groups_start','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control no-radius-right radius-left'))
                    .'<span class="input-group-addon no-radius-left no-radius-right"> TO </span>'.
                        Form::number('groups_end','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control'))
                .'</div>
                </div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['menu_sort'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">
                <div class="row">'.
                        Form::label('menu_sort', __('auth_menu.th_menu_sort'), array('class' => 'control-label col-xs-12'))
                .'</div>
                <div class="col-xs-12 search-number" >
                    <div class="input-group">'.
                        Form::number('menu_sort_start','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control no-radius-right radius-left'))
                    .'<span class="input-group-addon no-radius-left no-radius-right"> TO </span>'.
                        Form::number('menu_sort_end','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control'))
                .'</div>
                </div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['active'] ))?
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('active', __('auth_menu.th_active'), array('class' => 'control-label'))
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
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet">
<script src="{{asset('vendors/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() { 
    $('.select2_single').select2({
        placeholder: '{{ __("core.placeholder_select") }}',
        allowClear: true
    });
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
 * File Create : 2018-04-17 22:48:07 *
 */
-->