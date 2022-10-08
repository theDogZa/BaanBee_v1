@extends('layouts.app')
@section('title')
{{ ucfirst(__('item_category.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2>
    {!! config('core.icon.title_from') !!}
    {!! (!isset($item_category))?
        ucfirst(__('item_category.head_from_add'))  :  ucfirst(__('item_category.head_from_edit'))
    !!}
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
    <form action="{{ url('/item_categories'.( isset($item_category) ? "/" . $item_category->id : "")) }}" method="POST" class="form-horizontal form-process" id="form" >
            {{ csrf_field() }}      
         
            @if(isset($item_category))                
                {{ Form::hidden('_method','PATCH') }}
            @endif  


        {!! (!empty( $arrShowFieldFrom['item_type_id'] ))?       
            '<div class="form-group">'.               
                Form::label('item_type_id', __("item_category.label_item_type_id").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::select('item_type_id',['' => '']+$Item_type, @$item_category['item_type_id'] , array('placeholder'=>__("item_category.placeholder_item_type_id"),'class' => 'select2_single form-control','required','','data-parsley-errors-container'=>'#errors-messages-box-item_type_id' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_category.label_item_type_id")]) ))
                    .'<span id="errors-messages-box-item_type_id"></span>
                </div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['categories_name'] ))?       
            '<div class="form-group">'.
                Form::label('categories_name', __("item_category.label_categories_name").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('categories_name', @$item_category['categories_name'], 
                    array('placeholder'=>__("item_category.placeholder_categories_name"),'class' => 'form-control','id' => 'categories_name' ,'required','' , 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_category.label_categories_name")]) ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['categories_code'] ))?       
            '<div class="form-group">'.
                Form::label('categories_code', __("item_category.label_categories_code").' *', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.
                    Form::text('categories_code', @$item_category['categories_code'], 
                    array('placeholder'=>__("item_category.placeholder_categories_code"),'class' => 'form-control','id' => 'categories_code' ,'required',     
                    'data-parsley-required-message' =>  __("validation.required", ['attribute' => __("item_category.label_categories_code")]),
                    'data-parsley-remote'=>url("/item_categories/checkCode/".@$item_category['id']),
                    'data-parsley-remote-reverse'=> 'true',
                    'data-parsley-remote-message'=>  __("validation.unique", ['attribute' => __("item_category.label_categories_code")]), 
                    ))                
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowFieldFrom['categories_desc'] ))?
            '<div class="form-group">'.
                Form::label('categories_desc', __("item_category.label_categories_desc").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.               
                Form::textarea('categories_desc', @$item_category['categories_desc'], array('placeholder'=>__("item_category.placeholder_categories_desc"),'class' => 'form-control text-editor','','', 'data-parsley-error-message' =>  __("validation.required", ['attribute' => __("item_category.label_categories_desc")]) ))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowFieldFrom['active'] ))?
            '<div class="form-group">'.
                Form::label('active', __("item_category.label_active").' ', array('class' => 'col-sm-3 control-label'))
                .'<div class="col-sm-6">'.             
                     _createRadio('active',@$item_category['active'])
                .'</div>
            </div>'
        : '' !!}
        
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {!!  _createButtonSubmit() !!}
                {!!  _createButtonReset() !!}
                {!! _createButtonBack('item_categories') !!}              
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
 * File Create : 2018-04-28 17:51:42 *
 */
-->