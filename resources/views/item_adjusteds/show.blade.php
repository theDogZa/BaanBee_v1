@extends('layouts.app')
@section('title')
{{ ucfirst(__('item_adjusted.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
    <div class="x_title">
        <h2>{!! config('core.icon.title_view') !!}  {{ ucfirst(__('item_adjusted.head_view')) }}</h2>
        @include('partials._panel_toolbox')
        <div class="clearfix"></div>
    </div>
    <!--/.x_title -->
    <div class="x_content">           
        <form action="{{ url('/posts') }}" method="POST" class="form-horizontal">
            <div class="row">       
                                                                 
            {!! (!empty( $arrShowFieldView['doc_num'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.
                    Form::label('doc_num', __("item_adjusted.label_doc_num"), array('class' => config("core.layout.form.view.label"))) 
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('doc_num', @$results['doc_num'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                    .'</div>
                </div>'
            : '' !!}
                                                                                                                                                                             
            {!! (!empty( $arrShowFieldView['adjusted_desc'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.
                    Form::label('adjusted_desc', __("item_adjusted.label_adjusted_desc"), array('class' => config("core.layout.form.view.label")))
                .'<div class="'.config('core.layout.form.view.input').'">'.              
                    Form::textarea('adjusted_desc', @$results['adjusted_desc'], array('class' => 'form-control view-readonly' ,'readonly' => 'readonly'))
                .'</div>
                </div>'
            : '' !!}
                                                                                    
                                                
            {!! (!empty( $arrShowFieldView['date'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('date', __("item_adjusted.label_date"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('date', _datetime(@$results['date'],2)  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                    .'</div>
                </div>'
            : '' !!}
                                                                                                                                     
            {!! (!empty( $arrShowFieldView['adjusted_status'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('adjusted_status', __("item_adjusted.label_adjusted_status"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('adjusted_status', trans( "item_adjusted.adjusted_status_label.".$results['adjusted_status'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                    .'</div>
                </div>'
            : '' !!}
                                                                                                                                                                                                                                                                   
            {!! (!empty( $arrShowFieldView['active'] ))?           
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('active', __("item_adjusted.label_active"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('active', trans( "item_adjusted.active_label.".$results['active'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                    .'</div>
                </div>'
            : '' !!}
            </div>
        </form>
        <div class="ln_solid"></div>          
        <div class="form-group">
            <div class="{!! config('core.layout.form.view.button') !!}">
                {!! _createButtonBack('item_adjusteds') !!}
            </div>
        </div>  
    </div>
    <!--/.x_content -->
</div>
<!--/.x_panel -->
@endsection



<!--
/** 
 * CRUD Laravel
 * Master ฺBY Kepex  =>  https://github.com/kEpEx/laravel-crud-generator
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 24/07/2018 23:05
 * Version : ver.1.00.00
 *
 * File Create : 2018-07-25 00:17:45 *
 */
-->