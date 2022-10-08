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
                Form::label('parent_id', __('example.th_parent_id'), array('class' => 'control-label'))
                .'<div>'.
                Form::select('parent_id',['' => '']+$Example, @$example['parent_id'] , array('class' => 'select2_single form-control'))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowField['users_id'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.       
                Form::label('users_id', __('example.th_users_id'), array('class' => 'control-label'))
                .'<div>'.
                Form::select('users_id',['' => '']+$User, @$example['users_id'] , array('class' => 'select2_single form-control'))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowField['title'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('title', __('example.th_title'), array('class' => 'control-label'))
                . Form::text('title', @$example['title'],array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'title' ))               
            .'</div>'
        : '' !!} 

        {!! (!empty( $arrShowField['body'] ))?
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('body', __('example.th_body'), array('class' => 'control-label'))
                . Form::text('body', @$example['body'], array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'body' ))
            .'</div>'
        : '' !!}

        {!! (!empty( $arrShowField['amount'] ))?       
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">
                <div class="row">'.
                        Form::label('amount', __('example.th_amount'), array('class' => 'control-label col-xs-12'))
                .'</div>
                <div class="col-xs-12 search-number" >
                    <div class="input-group">'.
                        Form::number('amount_start','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control no-radius-right radius-left'))
                    .'<span class="input-group-addon no-radius-left no-radius-right"> TO </span>'.
                        Form::number('amount_end','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control'))
                .'</div>
                </div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['datetime'] ))?
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">
                <div class="row">'.
                        Form::label('datetime', __('example.th_datetime'), array('class' => 'control-label col-xs-12'))
                .'</div>
                <div class="col-xs-12 search-datetime-range">
                    <div class="input-group date datetimepicker input-left"  data-date-format="'. config('core.datetime-format-js').' " data-link-field = "datetime_start"
                            data-link-format = "yyyy-mm-dd hh:ii"  data-date-autoclose = "true" data-date-today-btn = "true"  >                       
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>'.
                            Form::text('',_datetime(@$request['datetime_start'],1), array('placeholder'=>__("core.placeholder_datetime"),'class' => 'form-control','data-inputmask'=> "'mask': 'd/m/y h:s'"))                             
                    .'<span class="input-group-addon no-radius-left no-radius-right"> TO </span>
                </div>
                
                    <div class="input-group date datetimepicker input-right"  data-date-format="'. config('core.datetime-format-js').' " data-link-field = "datetime_end"
                            data-link-format = "yyyy-mm-dd hh:ii"  data-date-autoclose = "true" data-date-today-btn = "true"  > '.
                            Form::text('',_datetime(@$request['datetime_end'],1), array('placeholder'=>__("core.placeholder_datetime"),'class' => 'form-control','data-inputmask'=> "'mask': 'd/m/y h:s'"))                             
                        .'<span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>'.
                    Form::hidden('datetime_start',@$request['datetime_start'], array('id' => 'datetime_start'))
                   .Form::hidden('datetime_end',@$request['datetime_end'], array('id' => 'datetime_end'))
            .'</div>'       
        : '' !!}

        {!! (!empty( $arrShowField['date'] ))?
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">
                <div class="row">'.
                        Form::label('date', __('example.th_date'), array('class' => 'control-label col-xs-12'))
                .'</div>
                <div class="col-xs-12 search-datetime-range">
                    <div class="input-group date datetimepicker input-left"  data-date-format="'.config('core.date-format-js').' " data-link-field = "date_start"
                            data-link-format = "yyyy-mm-dd" data-min-view = "2" data-date-autoclose = "true" data-date-today-btn = "true"  >                       
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>'.
                            Form::text('',_datetime(@$request['date_start'],2), array('placeholder'=>__("core.placeholder_date"),'class' => 'form-control','data-inputmask'=> "'mask': 'd/m/y'"))                             
                        .'<span class="input-group-addon no-radius-left no-radius-right"> TO </span>
                    </div>
               
                    <div class="input-group date datetimepicker input-right"  data-date-format="'. config('core.date-format-js').' " data-link-field = "date_end"
                            data-link-format = "yyyy-mm-dd" data-min-view = "2" data-date-autoclose = "true" data-date-today-btn = "true"  >'.
                            Form::text('',_datetime(@$request['date_end'],2), array('placeholder'=>__("core.placeholder_date"),'class' => 'form-control','data-inputmask'=> "'mask': 'd/m/y'"))                            
                        .'<span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>'.
                    Form::hidden('date_start',@$request['date_start'], array('id' => 'date_start'))
                   .Form::hidden('date_end',@$request['date_end'], array('id' => 'date_end'))
            .'</div>'
        : '' !!}

        {!! (!empty( $arrShowField['time'] ))?
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">
                <div class="row">'.
                        Form::label('time', __('example.th_time'), array('class' => 'control-label col-xs-12'))
                .'</div>
                <div class="col-xs-12 search-datetime-range">
                    <div class="input-group date datetimepicker input-left"  data-date-format="'. config('core.time-format-js').' " data-link-field = "time_start"
                            data-link-format = "hh:ii" data-max-view = "0" data-start-view = "0"  data-date-autoclose = "true" data-date-today-btn = "true">                       
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>'.
                            Form::text('',_datetime(@$request['time_start'],3), array('placeholder'=>__("core.placeholder_time"),'class' => 'form-control','data-inputmask'=> "'mask': 'h:s'"))                             
                        .'<span class="input-group-addon no-radius-left no-radius-right"> TO </span>
                    </div>
                
                    <div class="input-group date datetimepicker input-right"  data-date-format="'.config('core.time-format-js').' " data-link-field = "time_end"
                            data-link-format = "hh:ii" data-max-view = "0" data-start-view = "0"  data-date-autoclose = "true" data-date-today-btn = "true"  >'.
                            Form::text('',_datetime(@$request['time_end'],3), array('placeholder'=>__("core.placeholder_time"),'class' => 'form-control','data-inputmask'=> "'mask': 'h:s'"))                             
                        .'<span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </div>
                </div>'.
                    Form::hidden('time_start',@$request['time_start'], array('id' => 'time_start'))
                   .Form::hidden('time_end',@$request['time_end'], array('id' => 'time_end'))
            .'</div>'
        : '' !!}

        {!! (!empty( $arrShowField['status'] ))?     
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('status', __('example.th_status'), array('class' => 'control-label'))
            .'<div>'.
                 _createInputChoiceSearch('status',@$request['status'],@$arrstatus)
            .'</div>
        </div>'
        : '' !!}

        {!! (!empty( $arrShowField['active'] ))?
            '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group">'.
                Form::label('active', __('example.th_active'), array('class' => 'control-label'))
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
 * File Create : 2018-04-14 01:57:15 *
 */
-->