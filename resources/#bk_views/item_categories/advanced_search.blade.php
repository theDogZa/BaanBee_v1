<div class="x_panel panel_hide" id="panel_advanced_search">
    <div class="x_title">
        <h2>{!! config('core.icon.title_advanced_search') !!}  {{ ucfirst(__('core.title advanced search')) }} </h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
{!! Form::open(['url' => Request::path(),'method'=>'GET','class'=>'form-label-left input_mask form-process','id'=>'from-advanced-search']) !!}
<div class="row">


        {!! (!empty( $arrShowField['item_type_id'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.       
                Form::label('item_type_id', __('item_category.th_item_type_id'), array('class' => 'control-label'))
                .'<div>'.
                Form::select('item_type_id',['' => '']+$Item_type, '' , array('class' => 'select2_single form-control'))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowField['categories_name'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('categories_name', __('item_category.th_categories_name'), array('class' => 'control-label'))
                . Form::text('categories_name', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'categories_name' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['categories_code'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('categories_code', __('item_category.th_categories_code'), array('class' => 'control-label'))
                . Form::text('categories_code', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'categories_code' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['categories_desc'] ))?
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('categories_desc', __('item_category.th_categories_desc'), array('class' => 'control-label'))
                . Form::text('categories_desc', '', array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'categories_desc' ))
            .'</div>'
        : '' !!}

        {!! (!empty( $arrShowField['active'] ))?
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('active', __('item_category.th_active'), array('class' => 'control-label'))
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
 * File Create : 2018-04-28 17:51:42 *
 */
-->