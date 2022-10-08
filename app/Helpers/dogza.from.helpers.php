<?php
function _createRadio($name,$val=1,$arrRadio=array()) {
    $type=1;
    if(is_null($val)) $val = 1;

    $controller = _get_controller();
    $active_1 = trans(_model_singular($controller) . '.active_label.1');
    $active_0 = trans(_model_singular($controller) . '.active_label.0');

    if($type==1){
        $return = '<div class="switch-field">';     
        $return .= Form::radio($name,1, ($val == 1) ? true : '' ,['class' => 'switch_left','id'=> $name."_1"]) ;
        $return .= Form::label($name."_1", $active_1);     
        $return .= Form::radio($name,'0', ($val == 0) ? true : '' ,['class' => 'switch_right','id'=> $name."_0"]);
        $return .= Form::label($name.'_0', $active_0);
        $return .= '</div> ';
    }
    return $return;
}

function _createInputChoiceSearch($name, $val = '', $arrChoice = array())
{
    
    $controller = _get_controller();
    $countChoice = count($arrChoice);
    $active = "";
    
    if (is_null($val)) {
        $val = 'chkall';
        $active = "active";
    }

    if (!$arrChoice) {
        $arrChoice = ['0','1'];
    }
    
    $text = trans( "core.radio search all");
    $input = Form::radio($name,'', ($val == 'chkall') ? true : '', ['id'=> $name."_all"]);

    $return = '<div class="radio-list-search">';
    $return .= '<div class="btn-group-radio" data-toggle="buttons">';

    $return .= '<label class="label-radio btn ' . $active . '" > ' . $input . '<i class ="fa fa-circle-o fa-2x"> </i> <i class ="fa fa-dot-circle-o fa-2x"> </i><span>' . $text . '</span></label>';
    //$return .= '<label class ="label-radio">' . $input . "&nbsp;&nbsp;" . $text . '</label> ';

    foreach ($arrChoice as $key) {

        ($val == $key) ? $active = 'active' : $active = '';

        $text = trans(_model_singular($controller).".".$name.'_label.'.$key);
        $input = Form::radio($name, $key, ($val == $key) ? true : '', [ 'id' => $name."_".$key]);
        $return .= '<label class="label-radio btn ' . $active . '" > ' . $input . '<i class ="fa fa-circle-o fa-2x"> </i> <i class ="fa fa-dot-circle-o fa-2x"> </i><span>' . $text . '</span></label>';       
      //  $return .= '<label class ="label-radio">' . $input . "&nbsp;&nbsp;" . $text . '</label> ';  
    }
    $return .= '</div> </div>';
    return $return;

}


function _createInputRadio($name, $val = '', $arrRadio = array())
{
    $return = '<div class="btn-group-radio" data-toggle="buttons">';

    $controller = _get_controller();
 
    if(!$arrRadio){
        $arrRadio[1] = trans(_model_singular($controller) .".". $name . '_label.1');
        $arrRadio[0] = trans(_model_singular($controller) . "." . $name . '_label.0');   
    }
    
    foreach($arrRadio as $key){

        $text =  trans(_model_singular($controller) . "." . $name . '_label.'. $key);
        if (!$val){
            if(!@$chk) $val = $key;
            $chk=true;
        }
        ($val == $key) ? $active = 'active' : $active = '' ;

        $input = Form::radio($name, $key, ($val == $key) ? true : '');
        $return .= '<label class="label-radio btn '. $active .'" > '.$input.'<i class ="fa fa-circle-o fa-2x"> </i> <i class ="fa fa-dot-circle-o fa-2x"> </i><span>'. $text . '</span></label>';
    }

    $return .= '</div> ';

    return $return;
    
}

// function _createActive_index($name,$tableId,$val=1,$type=0) {

//     $controller = _get_controller();
//     $active_1 = trans(_model_singular($controller) . '.active_label.1');
//     $active_0 = trans(_model_singular($controller) . '.active_label.0');

//     if(!$type){

//         if($val == 1){
//             $return = '<span class="label label-success"><i class="fa fa-check" aria-hidden="true"></i> '. $active_1 .'</span>';
//         } elseif($val == 0) {
//             $return = '<span class="label label-danger"><i class="fa fa-ban" aria-hidden="true"></i> '. $active_0 .'</span>';
//         }

//     }elseif($type==1){  
//         $return = '<div class="switch-field">';
//         $return .= Form::radio($name.'-id-'.$tableId,1, ($val == 1) ? true : '' ,['class' => 'switch_radio_save switch_left','id'=>'switch_left-'.$tableId,'data-id' => $tableId]) ;           
//         $return .= Form::label('switch_left-'.$tableId, 'Yes');
//         $return .= Form::radio($name.'-id-'.$tableId,0, ($val == 0) ? true : '' ,['class' => 'switch_radio_save switch_right','id'=>'switch_right-'.$tableId,'data-id' => $tableId]);           
//         $return .= Form::label('switch_right-'.$tableId, 'No');
//         $return .= ' </div> ';
//     }
//     return $return;
// }

function _createTypeRadio($name, $tableId, $val = 1, $arr = array()){

    
    /** default */
    if (!@$arr['labelColor']) $labelColor = true;
    if (!@$arr['tagI']) $tagI = true;
    if (!@$arr['type']) $type = 0;



    if ($type == 0) {
        $return = _createLabelBox($name,$val, $labelColor,$tagI);
    }elseif($type == 1){
        $return = _createSwitch_2_Options($name, $tableId, $val);
    }

    return $return;

}

function _createLabelBox( $name , $val, $labelColor, $tagI )
{
    $controller = _get_controller();
    $textLabels = trans(_model_singular($controller) . '.' . $name . '_label.' . $val);
    

    $i = "";
    
        if ($labelColor == false) {
            $labelColor ="";       
        }elseif($labelColor==true){
        
            switch ($val) {
                case "0":
                    $labelColor = 'danger';
                    $defaultTagI = 'fa-ban';
                    break;
                case "1":
                    $labelColor = 'success';
                    $defaultTagI = 'fa-check';
                    break;
                case "2":
                    $labelColor = 'primary';
                    $defaultTagI = '';
                    break;
                case "3":
                    $labelColor = 'info';
                    $defaultTagI = '';
                    break;
                case "4":
                    $labelColor = 'warning';
                    $defaultTagI = '';
                    break;
                case "5":
                    $labelColor = 'default';
                    $defaultTagI = '';
                    break;
                default:
                    $labelColor = '';
                    $defaultTagI = '';
            }
        }

        if ($tagI == false) {
            $tagI = "";
        }elseif($tagI==true){
            $tagI = $defaultTagI;
            
        }
        if($tagI){
            $i = '<i class="fa ' . $tagI . '" aria-hidden="true"></i>';
        }
    

        $return = '<span class="label label-'.$labelColor.'">'. $i .' '.$textLabels. '</span>';
    
   
    return $return;
}

function _createSwitch_2_Options($name, $tableId, $val = 1, $type = 0)
{
    $controller = _get_controller();
    $active_1 = trans(_model_singular($controller) . '.active_label.1');
    $active_0 = trans(_model_singular($controller) . '.active_label.0');


    $return = '<div class="switch-field">';
    $return .= Form::radio($name . '-id-' . $tableId, 1, ($val == 1) ? true : '', ['class' => 'switch_radio_save switch_left', 'id' => 'switch_left-' . $tableId, 'data-id' => $tableId]);
    $return .= Form::label('switch_left-' . $tableId, 'Yes');
    $return .= Form::radio($name . '-id-' . $tableId, 0, ($val == 0) ? true : '', ['class' => 'switch_radio_save switch_right', 'id' => 'switch_right-' . $tableId, 'data-id' => $tableId]);
    $return .= Form::label('switch_right-' . $tableId, 'No');
    $return .= ' </div> ';

    return $return;
}

function _createActionsButtonList($id,$controller="",$type=1) {

    if($type==1){
    //     //$return = <a href=" url('users/' . $id . '/view') " class="btn btn-info btn-sm" title="View">  <i class="fa fa-eye" aria-hidden="true"></i></a>   
    //     //$return .=  <a href="{{ url('users/' . $id . '/edit') }}" class="btn btn-success btn-sm" title="Edit">  <i class="fa fa-pencil" aria-hidden="true"></i></a>      
    //     $route_view = url($controller.'/' . $id . '/view');
    //     $route_edit = url($controller.'/' . $id . '/edit');
        
    //     $return = '<a href="'.$route_view.'" class="btn btn-info btn-sm" title="View">  <i class="fa fa-eye" aria-hidden="true"></i> view </a>';
    //     $return .= '<a href="'.$route_edit.'" class="btn btn-success btn-sm" title="Edit">  <i class="fa fa-pencil" aria-hidden="true"></i> edit</a>';         
    //    // $return .= Form::open([ 'method'=>'DELETE', 'url' => [$controller, $id], 'style' => 'display:inline','id' => 'form-del-id-'.$id]) ;
    //     $return .= Form::button('<i class="fa fa-trash" aria-hidden="true"></i> del', ['type' => 'button', 'class' => 'btn btn-danger btn-sm btn-del','title' => 'Del','data-id' => $id]) ;
    //    // $return .= Form::close() ;
        $return = _createButtonView($id);
        $return .= _createButtonEdit($id);
        $return .= _createButtonDel($id);
    
    }
    return $return;
}

function _createButtonAdd($controller = "", $type = 1, $arr = array())
{
    $controller = _get_controller();
    $route = url($controller . '/create'); 
    $text = trans('core.button_add');
    
    if ($type == 1) {
        $return = '<a href = "'. $route .'" class = "btn btn-primary" title = "Add">'. config('core.icon.btn_add') . " " . $text .'</a>';
    }
    return $return;
}

function _createButtonEdit($id, $controller="", $type = 1, $arr = array())
{
    $controller = _get_controller();
    $route = url($controller . '/' . $id . '/edit');
    $text = trans('core.button_edit');

    if ($type == 1) {
        $return = '<a href="' . $route . '" class="btn btn-success btn-sm" title="Edit">'. config('core.icon.btn_edit') . " " . $text .'</a>';      
    }
    return $return;
}

function _createButtonView($id, $controller = "", $type = 1, $arr = array())
{
    $controller = _get_controller();
    $route = url($controller . '/' . $id );
    $text = trans('core.button_view');
    
    if ($type == 1) {
        $return = '<a href="' . $route . '" class="btn btn-info btn-sm" title="View" >'. config('core.icon.btn_view') . " " . $text.' </a>';
    }
    return $return;
}

function _createButtonDel($id, $controller = "", $type = 1, $arr = array())
{
    $controller = _get_controller();
    $text = trans('core.button_del');

    if ($type == 1) {
      
        $return = Form::button( config('core.icon.btn_del') . " " .$text, ['type' => 'button', 'class' => 'btn btn-danger btn-sm btn-del', 'title' => 'Del', 'data-id' => $id ]);

    }
    return $return;
}

function _createButtonBack($route_path="",$type=1) {

   // $route_back = url('/'.$route_path);
    $route_back = url()->previous();

    $text = trans('core.button_back');
    
    if($type==1){
        $return = '<a class="btn btn-default" href="'. $route_back .'">'. config('core.icon.btn_back') . " " . $text .'</a>';
    }
    return $return;
}

function _createButtonSubmit($type=1) {

    $text = trans('core.button_save');
    if($type==1){
        $return = '<button type="submit" class="btn btn-success">'.config('core.icon.btn_save') . " " .$text.'</button> ';
    }
    return $return;
}

function _createButtonSubmitDraft($type = 1)
{

    $text = trans('core.button_save_draft');
    if ($type == 1) {
        $return = '<button type="submit" class="btn btn-info">' . config('core.icon.btn_save_draft') . " " . $text . '</button> ';
    }
    return $return;
}

function _createButtonReset($type=1) {

    $text = trans('core.button_reset');
    if($type==1){
        $return = '<button type="reset" class="btn btn-warning btn-reset">'. config('core.icon.btn_reset') . " " . $text .'</button> ';
    }
    return $return;
}

function _createButtonSearch($val='', $arr=array())
{
    $text = trans('core.button_search');

    $typeForm = 1;
    if($val=='') $val = $text;
  
    $other ='';
    $class = 'btn btn-info';
    $type = 'button';
    $title = 'Search';
    foreach($arr as $k => $v){
        
        if($k == 'class'){
            if(!$v){ $class = 'btn btn-info'; }else{ $class = $v;}
        }elseif($k== 'type'){
            if(!$v){ $type = 'button'; }else{ $type = $v;}
        } elseif ($k == 'title') {
            if (!$v){ $title = 'Search'; }else{ $title = $v;}
        }else{
            $other .=  $k.'="'.$v.'" ';
        }
    }

    if ($typeForm == 1) {
        $return = '<button type="'. @$type .'" class="'. @$class .'" title="'. @$title .'" '. @$other .'>'. config('core.icon.btn_search') ." ". @$val .'</button> ';
    }
    return $return;
}

function _datetime($datetime = '', $format = ''){

    if (is_null($datetime)) $datetime = ''; 
    if(!$format){
        $format = config('core.date-default-format');
    } elseif ($format == 1) {
        $format = config('core.datetime-format');
    } elseif ($format == 2) {
        $format = config('core.date-format');
    } elseif ($format == 3) {
        $format = config('core.time-format');
    }

    if(!$datetime){
        //$return = Carbon\Carbon::now()->format($format);
        $return = '';
    }else{
        $return = Carbon\Carbon::parse($datetime)->format($format);
    }
    
    return $return; 
}

// function _fromatDateTimeJS($format = '')
// {

   
//     if (!$format) {
//         $format = config('core.date-default-format-js');
//     } elseif ($format == 1) {
//         $format = config('core.datetime-format-js');
//     } elseif ($format == 2) {
//         $format = config('core.date-format-js');
//     } elseif ($format == 3) {
//         $format = config('core.time-format-js');
//     }

    
//         $return = $format;
    

//     return $return;
// }

function _model_singular($controller,$count=1){

    $rest = substr($controller, -3); 
    if($rest=='ses'){
        $return = substr($controller, 0, -1);
    }else{
        $return = substr($controller, 0, -1);
    }
    
    return $return; 
}

function _get_controller()
{

    $routeArray = Request::route()->getAction();
    $controllerAction = class_basename($routeArray['controller']);
    list($controller, $action) = explode('@', $controllerAction);
    $controllerName = strtolower(str_replace('Controller', '', $controller));

    return $controllerName;
}

function _get_action()
{
    $action = Request::route()->getActionMethod();
    return $action;
}

function _listToSelect($arrField)
{
    $select[] = 'id';
    foreach ($arrField as $key => $val) {
        if ($val == 1) {
            $select[] = $key;
        }
    }
    return $select;
}

function _genCode($DocCh = '', $DocRun = '', $RunNum = '')
{

    $RunNum = (int)$RunNum;
    
    $RunNum = ($RunNum + 1);

    $ccp = (int)$DocRun;
    $deccp = $ccp - ($ccp * 2);

    $newRun = substr("0000000000000000000000000000" . $RunNum, $deccp, $ccp);

    $DocNum = $DocCh . $newRun;

    $code = $DocNum;

    return $code;
}
	




/** 
 *
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 06/04/2018 13:51
 * Version : v.10000
 *
 * File Create : 2018-04-17 23:16:07 
 */