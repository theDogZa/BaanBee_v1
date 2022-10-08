<div class="form-group pull-right top_search">
  {!! Form::open(['url' => Request::path(),'method'=>'GET','class'=>'form-process']) !!} 
    <div class="input-group">
      {{ Form::text('search','', array('placeholder'=>__('core.placeholder search'),'class' => 'form-control search','id' => 'input-search')) }} 
        <span class="input-group-btn">                
          {!! Form::button(config('core.icon.btn_search'). " ". __('core.button_search'), array('type'=>'submit','id'=>'btn-search','class' => 'btn btn-info btn-search','title' => 'Search','style'=>'margin-right:0px')) !!}
          {!! Form::button(config('core.icon.btn_advanced_search_open')." ". __("core.button_advanced_search"), array('class' => 'btn btn-default btn-panel-advanced-search','title' => 'Advanced Search')) !!}
        </span>
    </div>
  {!! Form::close() !!} 
</div>



<!--
/** 
 * 
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 11/04/2018 22:43
 * Version : v.10000
 */
-->