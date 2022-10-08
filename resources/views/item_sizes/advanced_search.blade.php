<div class="x_panel panel_hide" id="panel_advanced_search">
    <div class="x_title">
        <h2>{!! config('core.icon.title_advanced_search') !!}  {{ ucfirst(__('core.title advanced search')) }} </h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
    {!! Form::open(['url' => Request::path(),'method'=>'GET','class'=>'form-label-left input_mask form-process','id'=>'from-advanced-search']) !!}
        <div class="row">

        {!! (!empty( $arrShowField['size_name'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('size_name', __('item_size.th_size_name'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::text('size_name', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'size_name' ))               
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['size_code'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('size_code', __('item_size.th_size_code'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::text('size_code', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'size_code' ))               
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['size_desc'] ))?
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('size_desc', __('item_size.th_size_desc'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::text('size_desc', '', array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'size_desc' ))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowField['active'] ))?
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('active', __('item_size.th_active'), array('class' => config("core.layout.form.search.label")))
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
 * File Create : 2018-04-28 18:18:50 *
 */
-->