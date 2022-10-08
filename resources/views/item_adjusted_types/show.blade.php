@extends('layouts.app')
@section('title')
{{ ucfirst(__('item_adjusted_type.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
    <div class="x_title">
        <h2>{!! config('core.icon.title_view') !!}  {{ ucfirst(__('item_adjusted_type.head_view')) }}</h2>
        @include('partials._panel_toolbox')
        <div class="clearfix"></div>
    </div>
    <!--/.x_title -->
    <div class="x_content">           
        <form action="{{ url('/posts') }}" method="POST" class="form-horizontal">
            <div class="row">       
            {!! (!empty( $arrShowFieldView['adjusted_type_codes'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.
                    Form::label('adjusted_type_codes', __("item_adjusted_type.label_adjusted_type_codes"), array('class' => config("core.layout.form.view.label"))) 
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('adjusted_type_codes', @$results['adjusted_type_codes'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                    .'</div>
                </div>'
            : '' !!}
            {!! (!empty( $arrShowFieldView['adjusted_type_name_th'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.
                    Form::label('adjusted_type_name_th', __("item_adjusted_type.label_adjusted_type_name_th"), array('class' => config("core.layout.form.view.label"))) 
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('adjusted_type_name_th', @$results['adjusted_type_name_th'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                    .'</div>
                </div>'
            : '' !!}
            {!! (!empty( $arrShowFieldView['adjusted_type_name_en'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.
                    Form::label('adjusted_type_name_en', __("item_adjusted_type.label_adjusted_type_name_en"), array('class' => config("core.layout.form.view.label"))) 
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('adjusted_type_name_en', @$results['adjusted_type_name_en'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                    .'</div>
                </div>'
            : '' !!}
            {!! (!empty( $arrShowFieldView['adjusted_type_desc'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.
                    Form::label('adjusted_type_desc', __("item_adjusted_type.label_adjusted_type_desc"), array('class' => config("core.layout.form.view.label")))
                .'<div class="'.config('core.layout.form.view.input').'">'.              
                    Form::textarea('adjusted_type_desc', @$results['adjusted_type_desc'], array('class' => 'form-control view-readonly' ,'readonly' => 'readonly'))
                .'</div>
                </div>'
            : '' !!}
            {!! (!empty( $arrShowFieldView['active'] ))?           
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('active', __("item_adjusted_type.label_active"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('active', trans( "item_adjusted_type.active_label.".$results['active'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                    .'</div>
                </div>'
            : '' !!}
            </div>
        </form>
        <div class="ln_solid"></div>          
        <div class="form-group">
            <div class="{!! config('core.layout.form.view.button') !!}">
                {!! _createButtonBack('item_adjusted_types') !!}
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
 * File Create : 2018-07-25 22:06:10 *
 */
-->