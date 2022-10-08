<div class="x_panel panel_hide" id="panel_advanced_search">
    <div class="x_title">
        <h2>{!! config('core.icon.title_advanced_search') !!}  {{ ucfirst(__('core.title advanced search')) }} </h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
{!! Form::open(['url' => Request::path(),'method'=>'GET','class'=>'form-label-left input_mask form-process','id'=>'from-advanced-search']) !!}
<div class="row">


        {!! (!empty( $arrShowField['doc_num'] ))?       
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('doc_num', __('item_adjusted.th_doc_num'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::text('doc_num', '',array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'doc_num' ))               
                .'</div>
            </div>'
        : '' !!} 

        {!! (!empty( $arrShowField['adjusted_desc'] ))?
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('adjusted_desc', __('item_adjusted.th_adjusted_desc'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    Form::text('adjusted_desc', '', array('placeholder'=>__("core.placeholder_text"),'class' => 'form-control','id' => 'adjusted_desc' ))
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowField['date'] ))?
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('date', __('item_adjusted.th_date'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">
                    <div class="col-xs-12 search-datetime-range">
                        <div class="input-group date datetimepicker input-left"  data-date-format="'.config('core.date-format-js').' " data-link-field = "date_start"
                                data-link-format = "yyyy-mm-dd" data-min-view = "2" data-date-autoclose = "true" data-date-today-btn = "true"  >                       
                                <span class="input-group-addon">'. 
                                    config('core.icon.addon_date')
                                .'</span>'.
                                Form::text('',_datetime(@$request['date_start'],2), array('placeholder'=>__("core.placeholder_date"),'class' => 'form-control','data-inputmask'=> "'mask': 'd/m/y'"))                             
                            .'<span class="input-group-addon no-radius-left no-radius-right"> '. __("core.search_between") .' </span>
                        </div>
                
                        <div class="input-group date datetimepicker input-right"  data-date-format="'. config('core.date-format-js').' " data-link-field = "date_end"
                                data-link-format = "yyyy-mm-dd" data-min-view = "2" data-date-autoclose = "true" data-date-today-btn = "true"  >'.
                                Form::text('',_datetime(@$request['date_end'],2), array('placeholder'=>__("core.placeholder_date"),'class' => 'form-control','data-inputmask'=> "'mask': 'd/m/y'"))                            
                            .'<span class="input-group-addon">'. 
                                config('core.icon.addon_date')
                            .'</span>
                        </div>
                    </div>
                </div>'.
                    Form::hidden('date_start',@$request['date_start'], array('id' => 'date_start'))
                   .Form::hidden('date_end',@$request['date_end'], array('id' => 'date_end'))
            .'</div>'
        : '' !!}

        {!! (!empty( $arrShowField['adjusted_status'] ))?     
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('adjusted_status', __('item_adjusted.th_adjusted_status'), array('class' => config("core.layout.form.search.label")))
                .'<div class="'.config('core.layout.form.search.input').'">'.
                    _createInputChoiceSearch('adjusted_status',@$request['adjusted_status'],@$arradjusted_status)
                .'</div>
            </div>'
        : '' !!}

        {!! (!empty( $arrShowField['active'] ))?
            '<div class="'.config('core.layout.form.search.box').'">'.
                Form::label('active', __('item_adjusted.th_active'), array('class' => config("core.layout.form.search.label")))
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
 * Latest Update : 24/07/2018 23:00
 * Version : ver.1.00.00
 *
 * File Create : 2018-07-25 00:17:45 *
 */
-->