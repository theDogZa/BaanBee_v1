@extends('layouts.app')
@section('title')
  {{ ucfirst(__('[[model_singular]].head_title')) }} 
@stop

@section('title-right')
  {!! _createButtonAdd() !!}
@stop

@section('content')

@include('[[model_plural]].advanced_search')

<div class="x_panel panel_hide" id="panel_list">
  <div class="x_title">
    <h2>
      {!! config('core.icon.title_list') !!}  {{ ucfirst(__('[[model_singular]].head_list')) }}
      <!-- <small><b>results </b>=> '' </small> --> 
    </h2>
     @include('partials._panel_toolbox')
    <div class="clearfix"></div>
  </div>
  <!--/.x_title -->
  <div class="x_content">
      <div class="table table-responsive">
          <table class="table table-bordered table-striped table-hover" id="tbl[[model_singular]]">
              <thead>
                <tr>
                    <th class='no-sort text-center'> 
                      {{ __('core.th_actions') }}
                    </th>
                    [[foreach:columns_index]]

                    @if($arrShowField['[[i.name]]']==true) 
                    <th class="text-center">
                        @sortablelink('[[i.name]]',__('[[model_singular]].th_[[i.name]]'))
                    </th>
                    @endif
                    [[endforeach]]
                </tr>
            </thead>
            <tbody>
             @if(count($results)==0)
                <tr id="row-bank">
                    <td class="text-center" colspan="200"> {{ ucfirst(__('core.no records')) }} </td>
                </tr>
            @endif
            @foreach($results as $item)
                <tr id="row-item-id-{{$item->id}}">
                    <td class="text-center">
                    {!! _createActionsButtonList($item->id) !!}
                    </td>
[[foreach:columns_index]]
[[if:i.type=='select']]
                    {!! (!empty( $arrShowField['[[i.name]]'] ))?  '<td>'. $[[i.model_select]][$item->[[i.name]]] .'</td>' : ""   !!}
[[endif]]
[[if:i.type == 'text']]
                    {!! (!empty( $arrShowField['[[i.name]]'] ))?  '<td>'. $item->[[i.name]] .'</td>': ""   !!}
[[endif]]
[[if:i.type == 'textarea']]
                    {!! (!empty( $arrShowField['[[i.name]]'] ))? '<td>'. str_limit( $item->[[i.name]],config('core.textarea_limit'),config('core.textarea_end_str')).'</td>': ""   !!}
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type == 'number']]
                    {!! (!empty( $arrShowField['[[i.name]]'] ))?   '<td>'.  $item->[[i.name]] .'</td>': ""   !!}
[[endif]]
[[if:i.type == 'datetime']]
                    {!! (!empty( $arrShowField['[[i.name]]'] ))?  '<td>'. _datetime($item->[[i.name]],1) .'</td>': ""   !!}
[[endif]]
[[if:i.type == 'date']]
                    {!! (!empty( $arrShowField['[[i.name]]'] ))?  '<td>'.  _datetime($item->[[i.name]],2) .'</td>': ""   !!}
[[endif]]
[[if:i.type == 'time']]
                    {!! (!empty( $arrShowField['[[i.name]]'] ))?  '<td>'. _datetime($item->[[i.name]],3) .'</td>': ""   !!}
[[endif]]
[[if:i.type == 'radio']]
                    {!! (!empty( $arrShowField['[[i.name]]'] ))?  '<td class="text-center">'. _createTypeRadio( '[[i.name]]', $item->id , $item->[[i.name]] ) .'</td>': ""   !!}
[[endif]]
[[if:i.type == 'radio_active']]
                    {!! (!empty( $arrShowField['[[i.name]]'] ))? '<td class="text-center">'. _createTypeRadio( '[[i.name]]', $item->id , $item->[[i.name]] ) .'</td>': ""   !!}
[[endif]]
[[endforeach]]
[[foreach:columns_index]]
[[if:i.type == 'unknown']]
                    {!! (!empty( $arrShowField['[[i.name]]'] ))? '<td>'. $item->[[i.name]]. '</td>': ""   !!}     
[[endif]]
[[endforeach]]
                </tr>
              @endforeach
              </tbody>
          </table>
      </div>
      @include('partials._panel_pagination')
  </div>
  <div class="clearfix"></div>
  <!--/.x_content -->
</div>
<!--/.x_panel -->
{!! Form::open(['id' => 'form']) !!}     
{!! Form::close() !!}
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
 * File Create : [[datetimenow]]
 *
 */
-->
