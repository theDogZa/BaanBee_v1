<div class="x_panel panel_hide" id="panel_advanced_search">
    <div class="x_title">
        <h2>{!! config('core.icon.title_advanced_search') !!}  {{ ucfirst(__('core.title advanced search')) }} </h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
    {!! Form::open(['url' => Request::path(),'method'=>'GET','class'=>'form-label-left input_mask form-process','id'=>'from-advanced-search']) !!}
    <div class="row">
        {!! (!empty( $arrShowField['item_categorie_id'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.       
                Form::label('item_categorie_id', __('item.th_item_categorie_id'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::select('item_categorie_id',['' => '']+$Item_category, '' , array('class' => 'select2_single form-control'))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowField['item_size_id'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.       
                Form::label('item_size_id', __('item.th_item_size_id'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::select('item_size_id',['' => '']+$Item_size, '' , array('class' => 'select2_single form-control'))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowField['item_color_id'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.       
                Form::label('item_color_id', __('item.th_item_color_id'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::select('item_color_id',['' => '']+$Item_color, '' , array('class' => 'select2_single form-control'))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowField['item_unit_id'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.       
                Form::label('item_unit_id', __('item.th_item_unit_id'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::select('item_unit_id',['' => '']+$Item_unit, '' , array('class' => 'select2_single form-control'))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowField['item_name'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('item_name', __('item.th_item_name'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::text('item_name', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'item_name' ))               
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['item_code'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('item_code', __('item.th_item_code'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::text('item_code', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'item_code' ))               
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['item_num'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('item_num', __('item.th_item_num'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::text('item_num', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'item_num' ))               
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['item_sale_price'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('item_sale_price', __('item.th_item_sale_price'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').' search-number" >
                    <div class="input-group">'.
                        Form::number('item_sale_price_start','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control no-radius-right radius-left'))
                        .'<span class="input-group-addon no-radius-left no-radius-right"> TO </span>'.
                        Form::number('item_sale_price_end','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control'))
                    .'</div>
                </div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['item_cost_price'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('item_cost_price', __('item.th_item_cost_price'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').' search-number" >
                    <div class="input-group">'.
                        Form::number('item_cost_price_start','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control no-radius-right radius-left'))
                        .'<span class="input-group-addon no-radius-left no-radius-right"> TO </span>'.
                        Form::number('item_cost_price_end','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control'))
                .'</div>
                </div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['item_qty'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('item_qty', __('item.th_item_qty'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').' search-number" >
                    <div class="input-group">'.
                        Form::number('item_qty_start','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control no-radius-right radius-left'))
                    .'<span class="input-group-addon no-radius-left no-radius-right"> TO </span>'.
                        Form::number('item_qty_end','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control'))
                .'</div>
                </div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['item_qty_min'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('item_qty_min', __('item.th_item_qty_min'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').' search-number" >
                    <div class="input-group">'.
                        Form::number('item_qty_min_start','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control no-radius-right radius-left'))
                    .'<span class="input-group-addon no-radius-left no-radius-right"> TO </span>'.
                        Form::number('item_qty_min_end','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control'))
                .'</div>
                </div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['item_qty_max'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('item_qty_max', __('item.th_item_qty_max'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').' search-number" >
                    <div class="input-group">'.
                        Form::number('item_qty_max_start','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control no-radius-right radius-left'))
                    .'<span class="input-group-addon no-radius-left no-radius-right"> TO </span>'.
                        Form::number('item_qty_max_end','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control'))
                .'</div>
                </div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['item_sale_qty'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('item_sale_qty', __('item.th_item_sale_qty'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').' search-number" >
                    <div class="input-group">'.
                        Form::number('item_sale_qty_start','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control no-radius-right radius-left'))
                    .'<span class="input-group-addon no-radius-left no-radius-right"> TO </span>'.
                        Form::number('item_sale_qty_end','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control'))
                .'</div>
                </div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['item_desc'] ))?
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('item_desc', __('item.th_item_desc'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::text('item_desc', '', array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'item_desc' ))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowField['active'] ))?
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('active', __('item.th_active'), array('class' => config("core.layout.form.search.label")))
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
 * File Create : 2018-04-28 22:12:49 *
 */
-->