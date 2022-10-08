@extends('layouts.app')
@section('title')
{{ ucfirst(__('item_size.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
  <div class="x_title">
    <h2>{!! config('core.icon.title_view') !!} {{ ucfirst(__('item_size.head_view')) }}  </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">           
    <form action="{{ url('/posts') }}" method="POST" class="form-horizontal">        
                
        {!! (!empty( $arrShowFieldView['size_name'] ))?
            '<div class="{!! config('core.layout.form.view.button') !!}">'.
                 Form::label('size_name', __("item_size.label_size_name"), array('class' => config("core.layout.form.view.label"))) 
                .'<div class="'.config('core.layout.form.view.input').'">'.
                     Form::text('size_name', @$results['size_name'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                
        {!! (!empty( $arrShowFieldView['size_code'] ))?
            '<div class="{!! config('core.layout.form.view.button') !!}">'.
                 Form::label('size_code', __("item_size.label_size_code"), array('class' => config("core.layout.form.view.label"))) 
                .'<div class="'.config('core.layout.form.view.input').'">'.
                     Form::text('size_code', @$results['size_code'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                .'</div>
            </div>'
        : '' !!}
                                                                        
        {!! (!empty( $arrShowFieldView['size_desc'] ))?
            '<div class="{!! config('core.layout.form.view.button') !!}">'.
                Form::label('size_desc', __("item_size.label_size_desc"), array('class' => config("core.layout.form.view.label")))
            .'<div class="'.config('core.layout.form.view.input').'">'.              
                Form::textarea('size_desc', @$results['size_desc'], array('class' => 'form-control view-readonly' ,'readonly' => 'readonly'))
            .'</div>
            </div>'
        : '' !!}
                                                                                                                                                                                                                                                                                                                                        
        {!! (!empty( $arrShowFieldView['active'] ))?           
            '<div class="{!! config('core.layout.form.view.button') !!}">'.              
                Form::label('active', __("item_size.label_active"), array('class' => config("core.layout.form.view.label")))
                .'<div class="'.config('core.layout.form.view.input').'">'.
                    Form::text('active', trans( "item_size.active_label.".$results['active'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                .'</div>
            </div>'
        : '' !!}
                            
    </form>
        <div class="ln_solid"></div>          
        <div class="form-group">
            <div class="{!! config('core.layout.form.view.button') !!}">
                {!! _createButtonBack('item_sizes') !!}
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
 * Latest Update : 06/04/2018 13:51
 * Version : ver.1.00.00
 *
 * File Create : 2018-04-28 18:18:50 *
 */
-->