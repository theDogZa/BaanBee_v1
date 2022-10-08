@extends('layouts.app')
@section('title')
{{ ucfirst(__('[[model_singular]].head_title')) }} 
@stop

@section('content')

<div class="x_panel">
    <div class="x_title">
        <h2>{!! config('core.icon.title_view') !!}  {{ ucfirst(__('[[model_singular]].head_view')) }}</h2>
        @include('partials._panel_toolbox')
        <div class="clearfix"></div>
    </div>
    <!--/.x_title -->
    <div class="x_content">           
        <form action="{{ url('/posts') }}" method="POST" class="form-horizontal">
            <div class="row">       
[[foreach:columns_index]]
[[if:i.type=='text']]
            {!! (!empty( $arrShowFieldView['[[i.name]]'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.
                    Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]"), array('class' => config("core.layout.form.view.label"))) 
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('[[i.name]]', @$results['[[i.name]]'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                    .'</div>
                </div>'
            : '' !!}
[[endif]]
[[if:i.type=='number']]
            {!! (!empty( $arrShowFieldView['[[i.name]]'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.
                    Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]"), array('class' => config("core.layout.form.view.label"))) 
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::number('[[i.name]]',@$results['[[i.name]]'], array('class' => 'form-control view-readonly','readonly' => 'readonly')) 
                    .'</div>
                </div>'
            : '' !!}
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type=='textarea']]
            {!! (!empty( $arrShowFieldView['[[i.name]]'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.
                    Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.              
                    Form::textarea('[[i.name]]', @$results['[[i.name]]'], array('class' => 'form-control view-readonly' ,'readonly' => 'readonly'))
                    .'</div>
                </div>'
            : '' !!}
[[endif]]
[[if:i.type=='select']]
            {!! (!empty( $arrShowFieldView['[[i.name]]'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('[[i.name]]',  @$[[i.model_select]][@$results['[[i.name]]']]  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                    .'</div>
                </div>'
            : '' !!}
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type=='datetime']]
            {!! (!empty( $arrShowFieldView['[[i.name]]'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('[[i.name]]', _datetime(@$results['[[i.name]]'],1)  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                    .'</div>
                </div>'
            : '' !!}
[[endif]]
[[if:i.type=='date']]
            {!! (!empty( $arrShowFieldView['[[i.name]]'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('[[i.name]]', _datetime(@$results['[[i.name]]'],2)  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                    .'</div>
                </div>'
            : '' !!}
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type=='time']]
            {!! (!empty( $arrShowFieldView['[[i.name]]'] ))?  
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('[[i.name]]', _datetime(@$results['[[i.name]]'],3)  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                    .'</div>
                </div>'
            : '' !!}
[[endif]]
[[if:i.type=='radio']]
            {!! (!empty( $arrShowFieldView['[[i.name]]'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('[[i.name]]', trans( "[[model_singular]].[[i.name]]_label.".$results['[[i.name]]'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                    .'</div>
                </div>'
            : '' !!}
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type=='radio_active']]
            {!! (!empty( $arrShowFieldView['[[i.name]]'] ))?           
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('[[i.name]]', trans( "[[model_singular]].active_label.".$results['[[i.name]]'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                    .'</div>
                </div>'
            : '' !!}
[[endif]]
[[if:i.type=='unknown']]
            {!! (!empty( $arrShowFieldView['[[i.name]]'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.
                    Form::label('[[i.name]]', __("[[model_singular]].label_[[i.name]]"), array('class' => config("core.layout.form.view.label"))) 
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::number('[[i.name]]',@$results['[[i.name]]'], array('class' => 'form-control view-readonly','readonly' => 'readonly')) 
                    .'</div>
                </div>'
            : '' !!}
[[endif]]
[[endforeach]]
            </div>
        </form>
        <div class="ln_solid"></div>          
        <div class="form-group">
            <div class="{!! config('core.layout.form.view.button') !!}">
                {!! _createButtonBack('[[route_path]]') !!}
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
 * File Create : [[datetimenow]]
 *
 */
-->