@extends('layouts.app')
@section('title')
{{ ucfirst(__('example.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
    <div class="x_title">
        <h2>{!! config('core.icon.title_view') !!}  {{ ucfirst(__('example.head_view')) }}</h2>
        @include('partials._panel_toolbox')
        <div class="clearfix"></div>
    </div>
    <!--/.x_title -->
    <div class="x_content">           
        <form action="{{ url('/posts') }}" method="POST" class="form-horizontal">
            <div class="row">       
            {!! (!empty( $arrShowFieldView['title'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.
                    Form::label('title', __("example.label_title"), array('class' => config("core.layout.form.view.label"))) 
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('title', @$results['title'], array('class' => 'form-control view-readonly','readonly' => 'readonly'))                  
                    .'</div>
                </div>'
            : '' !!}
            {!! (!empty( $arrShowFieldView['amount'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.
                    Form::label('amount', __("example.label_amount"), array('class' => config("core.layout.form.view.label"))) 
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::number('amount',@$results['amount'], array('class' => 'form-control view-readonly','readonly' => 'readonly')) 
                    .'</div>
                </div>'
            : '' !!}
            {!! (!empty( $arrShowFieldView['parent_id'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('parent_id', __("example.label_parent_id"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('parent_id',  @$Example[@$results['parent_id']]  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                    .'</div>
                </div>'
            : '' !!}
            {!! (!empty( $arrShowFieldView['users_id'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('users_id', __("example.label_users_id"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('users_id',  @$Userss[@$results['users_id']]  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                    .'</div>
                </div>'
            : '' !!}
            {!! (!empty( $arrShowFieldView['body'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.
                    Form::label('body', __("example.label_body"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.              
                    Form::textarea('body', @$results['body'], array('class' => 'form-control view-readonly' ,'readonly' => 'readonly'))
                    .'</div>
                </div>'
            : '' !!}
            {!! (!empty( $arrShowFieldView['date'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('date', __("example.label_date"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('date', _datetime(@$results['date'],2)  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                    .'</div>
                </div>'
            : '' !!}
            {!! (!empty( $arrShowFieldView['datetime'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('datetime', __("example.label_datetime"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('datetime', _datetime(@$results['datetime'],1)  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                    .'</div>
                </div>'
            : '' !!}
            {!! (!empty( $arrShowFieldView['time'] ))?  
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('time', __("example.label_time"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('time', _datetime(@$results['time'],3)  , array('class' => 'form-control view-readonly','readonly' => 'readonly'))   
                    .'</div>
                </div>'
            : '' !!}
            {!! (!empty( $arrShowFieldView['status'] ))?
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('status', __("example.label_status"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('status', trans( "example.status_label.".$results['status'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                    .'</div>
                </div>'
            : '' !!}
            {!! (!empty( $arrShowFieldView['active'] ))?           
                '<div class="'.config('core.layout.form.view.box').'">'.              
                    Form::label('active', __("example.label_active"), array('class' => config("core.layout.form.view.label")))
                    .'<div class="'.config('core.layout.form.view.input').'">'.
                        Form::text('active', trans( "example.active_label.".$results['active'] ) ,array('class' => 'form-control view-readonly','readonly' => 'readonly' ))   
                    .'</div>
                </div>'
            : '' !!}
            </div>
        </form>
        <div class="ln_solid"></div>          
        <div class="form-group">
            <div class="{!! config('core.layout.form.view.button') !!}">
                {!! _createButtonBack('examples') !!}
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
 * File Create : 2019-11-29 18:09:18 *
 */
-->