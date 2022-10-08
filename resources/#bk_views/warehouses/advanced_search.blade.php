<div class="x_panel panel_hide" id="panel_advanced_search">
    <div class="x_title">
        <h2>{!! config('core.icon.title_advanced_search') !!}  {{ ucfirst(__('core.title advanced search')) }} </h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
{!! Form::open(['url' => Request::path(),'method'=>'GET','class'=>'form-label-left input_mask form-process','id'=>'from-advanced-search']) !!}
<div class="row">


        {!! (!empty( $arrShowField['warehouse_name'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('warehouse_name', __('warehouse.th_warehouse_name'), array('class' => 'control-label'))
                . Form::text('warehouse_name', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'warehouse_name' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['warehouse_code'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('warehouse_code', __('warehouse.th_warehouse_code'), array('class' => 'control-label'))
                . Form::text('warehouse_code', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'warehouse_code' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['province_id'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.       
                Form::label('province_id', __('warehouse.th_province_id'), array('class' => 'control-label'))
                .'<div>'.
                Form::select('province_id',['' => '']+$Province, '' , array('class' => 'select2_single form-control'))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowField['warehouse_tel1'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('warehouse_tel1', __('warehouse.th_warehouse_tel1'), array('class' => 'control-label'))
                . Form::text('warehouse_tel1', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'warehouse_tel1' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['warehouse_tel2'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('warehouse_tel2', __('warehouse.th_warehouse_tel2'), array('class' => 'control-label'))
                . Form::text('warehouse_tel2', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'warehouse_tel2' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['warehouse_address'] ))?
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('warehouse_address', __('warehouse.th_warehouse_address'), array('class' => 'control-label'))
                . Form::text('warehouse_address', '', array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'warehouse_address' ))
            .'</div>'
        : '' !!}

        {!! (!empty( $arrShowField['warehouse_desc'] ))?
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('warehouse_desc', __('warehouse.th_warehouse_desc'), array('class' => 'control-label'))
                . Form::text('warehouse_desc', '', array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'warehouse_desc' ))
            .'</div>'
        : '' !!}

        {!! (!empty( $arrShowField['active'] ))?
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('active', __('warehouse.th_active'), array('class' => 'control-label'))
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
 * File Create : 2018-05-15 22:39:53 *
 */
-->