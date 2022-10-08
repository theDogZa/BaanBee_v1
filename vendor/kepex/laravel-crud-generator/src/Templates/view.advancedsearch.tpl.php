<div class="x_panel panel_hide" id="panel_advanced_search">
    <div class="x_title">
        <h2>{!! config('core.icon.title_advanced_search') !!}  {{ ucfirst(__('core.title advanced search')) }} </h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
{!! Form::open(['url' => Request::path(),'method'=>'GET','class'=>'form-label-left input_mask form-process','id'=>'from-advanced-search']) !!}
<div class="row">

[[foreach:columns_index]]
[[if:i.type=='select']]

        {!! (!empty( $arrShowField['[[i.name]]'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.       
                Form::label('[[i.name]]', __('[[model_singular]].th_[[i.name]]'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                Form::select('[[i.name]]',['' => '']+$[[i.model_select]], '' , array('class' => 'select2_single form-control'))
                .'</div>
            </div>'
        : '' !!}
[[endif]]
[[if:i.type=='text']]

        {!! (!empty( $arrShowField['[[i.name]]'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('[[i.name]]', __('[[model_singular]].th_[[i.name]]'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::text('[[i.name]]', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => '[[i.name]]' ))               
                .'</div>
            </div>'
        : '' !!} 
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type=='number']]

        {!! (!empty( $arrShowField['[[i.name]]'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('[[i.name]]', __('[[model_singular]].th_[[i.name]]'), array('class' => config("core.layout.form.search.label") ))
                .'<div class="'.config('core.layout.form.search.input').'">
                    <div class="col-xs-12 search-number" >
                        <div class="input-group">'.
                            Form::number('[[i.name]]_start','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control no-radius-right radius-left'))
                        .'<span class="input-group-addon no-radius-left no-radius-right"> '. __("core.search_between") .' </span>'.
                            Form::number('[[i.name]]_end','', array('placeholder'=>__("core.placeholder_number"),'class' => 'form-control'))
                    .'</div>
                    </div>
                </div>
            </div>'
        : '' !!} 
[[endif]]
[[if:i.type=='textarea']]

        {!! (!empty( $arrShowField['[[i.name]]'] ))?
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('[[i.name]]', __('[[model_singular]].th_[[i.name]]'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::text('[[i.name]]', '', array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => '[[i.name]]' ))
                .'</div>
            </div>'
        : '' !!}
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type=='datetime']]

        {!! (!empty( $arrShowField['[[i.name]]'] ))?
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('[[i.name]]', __('[[model_singular]].th_[[i.name]]'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">
                    <div class="col-xs-12 search-datetime-range">
                        <div class="input-group date datetimepicker input-left"  data-date-format="'. config('core.datetime-format-js').' " data-link-field = "[[i.name]]_start"
                                data-link-format = "yyyy-mm-dd hh:ii"  data-date-autoclose = "true" data-date-today-btn = "true"  >                       
                                <span class="input-group-addon">'. 
                                    config('core.icon.addon_datetime')
                            .'</span>'.
                                Form::text('',_datetime(@$request['[[i.name]]_start'],1), array('placeholder'=>__("core.placeholder_datetime"),'class' => 'form-control','data-inputmask'=> "'mask': 'd/m/y h:s'"))                             
                        .'<span class="input-group-addon no-radius-left no-radius-right">'. __("core.search_between") .'</span>
                        </div>
                        <div class="input-group date datetimepicker input-right"  data-date-format="'. config('core.datetime-format-js').' " data-link-field = "[[i.name]]_end"
                            data-link-format = "yyyy-mm-dd hh:ii"  data-date-autoclose = "true" data-date-today-btn = "true"  > '.
                                Form::text('',_datetime(@$request['[[i.name]]_end'],1), array('placeholder'=>__("core.placeholder_datetime"),'class' => 'form-control','data-inputmask'=> "'mask': 'd/m/y h:s'"))                             
                            .'<span class="input-group-addon">'. 
                                config('core.icon.addon_datetime')
                            .'</span>
                        </div>
                    </div>
                </div>'.
                    Form::hidden('[[i.name]]_start',@$request['[[i.name]]_start'], array('id' => '[[i.name]]_start'))
                   .Form::hidden('[[i.name]]_end',@$request['[[i.name]]_end'], array('id' => '[[i.name]]_end'))
            .'</div>'       
        : '' !!}
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type=='date']]

        {!! (!empty( $arrShowField['[[i.name]]'] ))?
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('[[i.name]]', __('[[model_singular]].th_[[i.name]]'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">
                    <div class="col-xs-12 search-datetime-range">
                        <div class="input-group date datetimepicker input-left"  data-date-format="'.config('core.date-format-js').' " data-link-field = "[[i.name]]_start"
                                data-link-format = "yyyy-mm-dd" data-min-view = "2" data-date-autoclose = "true" data-date-today-btn = "true"  >                       
                                <span class="input-group-addon">'. 
                                    config('core.icon.addon_date')
                                .'</span>'.
                                Form::text('',_datetime(@$request['[[i.name]]_start'],2), array('placeholder'=>__("core.placeholder_date"),'class' => 'form-control','data-inputmask'=> "'mask': 'd/m/y'"))                             
                            .'<span class="input-group-addon no-radius-left no-radius-right"> '. __("core.search_between") .' </span>
                        </div>
                
                        <div class="input-group date datetimepicker input-right"  data-date-format="'. config('core.date-format-js').' " data-link-field = "[[i.name]]_end"
                                data-link-format = "yyyy-mm-dd" data-min-view = "2" data-date-autoclose = "true" data-date-today-btn = "true"  >'.
                                Form::text('',_datetime(@$request['[[i.name]]_end'],2), array('placeholder'=>__("core.placeholder_date"),'class' => 'form-control','data-inputmask'=> "'mask': 'd/m/y'"))                            
                            .'<span class="input-group-addon">'. 
                                config('core.icon.addon_date')
                            .'</span>
                        </div>
                    </div>
                </div>'.
                    Form::hidden('[[i.name]]_start',@$request['[[i.name]]_start'], array('id' => '[[i.name]]_start'))
                   .Form::hidden('[[i.name]]_end',@$request['[[i.name]]_end'], array('id' => '[[i.name]]_end'))
            .'</div>'
        : '' !!}
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type=='time']]

        {!! (!empty( $arrShowField['[[i.name]]'] ))?
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('[[i.name]]', __('[[model_singular]].th_[[i.name]]'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">
                    <div class="col-xs-12 search-datetime-range">
                        <div class="input-group date datetimepicker input-left"  data-date-format="'. config('core.time-format-js').' " data-link-field = "[[i.name]]_start"
                                data-link-format = "hh:ii" data-max-view = "0" data-start-view = "0"  data-date-autoclose = "true" data-date-today-btn = "true">                       
                                <span class="input-group-addon">'. 
                                    config('core.icon.addon_time')
                                .'</span>'.
                                Form::text('',_datetime(@$request['[[i.name]]_start'],3), array('placeholder'=>__("core.placeholder_time"),'class' => 'form-control','data-inputmask'=> "'mask': 'h:s'"))                             
                            .'<span class="input-group-addon no-radius-left no-radius-right"> '. __("core.search_between") .' </span>
                        </div>
                    
                        <div class="input-group date datetimepicker input-right"  data-date-format="'.config('core.time-format-js').' " data-link-field = "[[i.name]]_end"
                                data-link-format = "hh:ii" data-max-view = "0" data-start-view = "0"  data-date-autoclose = "true" data-date-today-btn = "true"  >'.
                                Form::text('',_datetime(@$request['[[i.name]]_end'],3), array('placeholder'=>__("core.placeholder_time"),'class' => 'form-control','data-inputmask'=> "'mask': 'h:s'"))                             
                            .'<span class="input-group-addon">'. 
                                config('core.icon.addon_time')
                            .'</span>
                        </div>
                    </div>
                </div>'.
                    Form::hidden('[[i.name]]_start',@$request['[[i.name]]_start'], array('id' => '[[i.name]]_start'))
                   .Form::hidden('[[i.name]]_end',@$request['[[i.name]]_end'], array('id' => '[[i.name]]_end'))
            .'</div>'
        : '' !!}
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type=='radio']]

        {!! (!empty( $arrShowField['[[i.name]]'] ))?     
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('[[i.name]]', __('[[model_singular]].th_[[i.name]]'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    _createInputChoiceSearch('[[i.name]]',@$request['[[i.name]]'],@$arr[[i.name]])
                .'</div>
            </div>'
        : '' !!}
[[endif]]
[[if:i.type=='radio_active']]

        {!! (!empty( $arrShowField['[[i.name]]'] ))?
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('[[i.name]]', __('[[model_singular]].th_[[i.name]]'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                  _createInputChoiceSearch('[[i.name]]',@$request['[[i.name]]'])
                .'</div>
            </div>'
        : '' !!}
[[endif]]
[[if:i.type=='unknown']]

        {!! (!empty( $arrShowFieldFrom['[[i.name]]'] ))?
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('[[i.name]]', __('[[model_singular]].th_[[i.name]]'), array('class' => config("core.layout.form.search.label")))
                 .'<div class="'.config('core.layout.form.search.input').'" >'.
                Form::text('[[i.name]]',@$[[model_singular]]['[[i.name]]'], array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => '[[i.name]]')) 
                .'</div>
            </div>'
        : '' !!}
[[endif]]
[[endforeach]]
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

[[if:columns_type_datetime=='true']]
<script src="{{asset('vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
<link href="{{asset('vendors/datetimepicker/bootstrap-datetimepicker.css')}}" rel="stylesheet">
<script src="{{asset('vendors/datetimepicker/bootstrap-datetimepicker.js')}}"></script>
<script src="{{asset('vendors/datetimepicker/locales/bootstrap-datepicker.th.min.js')}}"></script>
[[endif]]
[[if:columns_type_select=='true']]
<link href="{{asset('vendors/select2/css/select2.min.css')}}" rel="stylesheet">
<script src="{{asset('vendors/select2/js/select2.full.min.js')}}"></script>
[[endif]]
<script type="text/javascript">
$(document).ready(function() { 
[[if:columns_type_select=='true']]
    $('.select2_single').select2({
        placeholder: '{{ __("core.placeholder_select") }}',
        allowClear: true
    });
[[endif]]
[[if:columns_type_datetime=='true']]
    $('.datetimepicker').datetimepicker();
    $(":input").inputmask();
[[endif]]
    
 });
</script>
@endsection



<!--
/** 
 * CRUD Laravel
 * Master ฺBY Kepex  =>  https://github.com/kEpEx/laravel-crud-generator
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 24/07/2018 23:00
 * Version : ver.1.00.00
 *
 * File Create : [[datetimenow]]
 *
 */
-->