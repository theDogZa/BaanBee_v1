<div class="x_panel panel_hide" id="panel_advanced_search">
    <div class="x_title">
        <h2>{!! config('core.icon.title_advanced_search') !!}  {{ ucfirst(__('core.title advanced search')) }} </h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
{!! Form::open(['url' => Request::path(),'method'=>'GET','class'=>'form-label-left input_mask form-process','id'=>'from-advanced-search']) !!}
<div class="row">


        {!! (!empty( $arrShowField['adjusted_type_codes'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('adjusted_type_codes', __('item_adjusted_type.th_adjusted_type_codes'), array('class' => 'control-label'))
                . Form::text('adjusted_type_codes', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'adjusted_type_codes' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['adjusted_type_name_th'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('adjusted_type_name_th', __('item_adjusted_type.th_adjusted_type_name_th'), array('class' => 'control-label'))
                . Form::text('adjusted_type_name_th', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'adjusted_type_name_th' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['adjusted_type_name_en'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('adjusted_type_name_en', __('item_adjusted_type.th_adjusted_type_name_en'), array('class' => 'control-label'))
                . Form::text('adjusted_type_name_en', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'adjusted_type_name_en' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['adjusted_type_desc'] ))?
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('adjusted_type_desc', __('item_adjusted_type.th_adjusted_type_desc'), array('class' => 'control-label'))
                . Form::text('adjusted_type_desc', '', array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'adjusted_type_desc' ))
            .'</div>'
        : '' !!}

        {!! (!empty( $arrShowField['active'] ))?
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('active', __('item_adjusted_type.th_active'), array('class' => 'control-label'))
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
 * File Create : 2018-07-24 01:07:15 *
 */
-->