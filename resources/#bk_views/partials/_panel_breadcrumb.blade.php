<div class="panel_breadcrumb">
{!! config('core.icon.breadcrumb_home') !!}
{{ HTML::link('/', __('core.breadcrumd home')) }} 
/ {{ HTML::link('/'._get_controller(), trans(ucfirst(str_singular(_get_controller())).'.controllername') )}} 
/ {{ trans(_model_singular(_get_controller()).'.'._get_action()) }}
</div>



<!--
/** 
 * 
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 28/04/2018 19:08
 * Version : v.10000
 */
-->



