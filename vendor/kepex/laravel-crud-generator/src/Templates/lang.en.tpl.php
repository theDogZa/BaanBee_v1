<?php

return [

    /*
    |--------------------------------------------------------------------------
    | [[model_plural]] Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the [[model_plural]] library to build
    | the simple [[model_plural]] links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

/* breadcrumd */
    'controllername' => '[[model_name_plural]] ',
    'index' => ' Lists ',
    'create' => ' Add ',
    'edit' => ' Edit ',
    'show' => ' Show ',

    'head_title' => '[[model_name_plural]] management system',
    'head_from_add' => 'Add [[model_name]]',
    'head_from_edit' => 'Edit [[model_name]]',
    'head_view' => 'View [[model_name]]',
    'head_list' => 'List of [[model_name_plural]]',
    
    'active_label' => array('1' => 'Is Active', '0' => 'Not Active'),
    'status_label' => array( '0' => 'status_0', '1' => 'status_1', '2' => 'status_2', '3' => 'status_3', '4' => 'status_4', '5' => 'status_5'),

[[foreach:columns]]
    'th_[[i.name]]' => '[[i.display]]',
[[endforeach]]

/** for label add.blade.php */
[[foreach:columns]]
    'label_[[i.name]]' => '[[i.display]]',
[[endforeach]]

/** for placeholder add.blade.php */
[[foreach:columns]]
    'placeholder_[[i.name]]' => '[[i.display]]',
[[endforeach]]


];



/** 
 * CRUD Laravel
 * Master ฺBY Kepex  =>  https://github.com/kEpEx/laravel-crud-generator
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 06/04/2018 13:51
 * Version : v.10000
 *
 * File Create : [[datetimenow]]
 *
 */