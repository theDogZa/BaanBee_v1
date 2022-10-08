<div class="x_panel panel_hide" id="panel_advanced_search">
    <div class="x_title">
        <h2>{!! config('core.icon.title_advanced_search') !!}  {{ ucfirst(__('core.title advanced search')) }} </h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
    {!! Form::open(['url' => Request::path(),'method'=>'GET','class'=>'form-label-left input_mask form-process','id'=>'from-advanced-search']) !!}
    <div class="row">
        {!! (!empty( $arrShowField['warehouse_id'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.       
                Form::label('warehouse_id', __('warehouse_item.th_warehouse_id'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::select('warehouse_id',['' => '']+$Warehouse, '' , array('class' => 'select2_single form-control'))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowField['item_id'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.       
                Form::label('item_id', __('warehouse_item.th_item_id'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::select('item_id',['' => '']+$Item, '' , array('class' => 'select2_single form-control'))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowField['qty'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('qty', __('warehouse_item.th_qty'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').' search-number" >
                    <div class="input-group">'.
                        Form::number('qty_start','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control no-radius-right radius-left'))
                    .'<span class="input-group-addon no-radius-left no-radius-right"> TO </span>'.
                        Form::number('qty_end','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control'))
                .'</div>
                </div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['min_qty'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('min_qty', __('warehouse_item.th_min_qty'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').' search-number" >
                    <div class="input-group">'.
                        Form::number('min_qty_start','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control no-radius-right radius-left'))
                    .'<span class="input-group-addon no-radius-left no-radius-right"> TO </span>'.
                        Form::number('min_qty_end','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control'))
                .'</div>
                </div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['max_qty'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('max_qty', __('warehouse_item.th_max_qty'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').' search-number" >
                    <div class="input-group">'.
                        Form::number('max_qty_start','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control no-radius-right radius-left'))
                    .'<span class="input-group-addon no-radius-left no-radius-right"> TO </span>'.
                        Form::number('max_qty_end','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control'))
                .'</div>
                </div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['warehouse_item_desc'] ))?
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('warehouse_item_desc', __('warehouse_item.th_warehouse_item_desc'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::text('warehouse_item_desc', '', array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'warehouse_item_desc' ))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowField['active'] ))?
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('active', __('warehouse_item.th_active'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                  _createInputChoiceSearch('active',@$request['active'])
                .'</div>
            </div>'
        : '' !!}
    <div class="clearfix"></div>
</div>      
<div class="ln_solid"></div>
<div class="{!! config('core.layout.form.search.button') !!}" style="height: 20px;">
  
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
 * File Create : 2018-05-15 22:59:05 *
 */
-->