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
    'controllername' => ' [[model_uc_plural]] ',
    'index' => ' รายการ ',
    'create' => ' เพิ่ม ',
    'edit' => ' แก้ไข ',
    'show' => ' แสดง ',

    'head_title' => 'ระบบการจัดการ [[model_uc_plural]]',
    'head_from_add' => 'เพิ่ม [[model_uc]]',
    'head_from_edit' => 'แก้ไข [[model_uc]]',
    'head_view' => 'แสดง [[model_uc]]',
    'head_list' => 'รายการ [[model_uc_plural]]',
    
    'active_label' => array('1' => 'ใช้งาน', '0' => 'ไม่ใช้งาน'),
    'status_label' => array('0' => 'สถานะ 0', '1' => 'สถานะ 1', '2' => 'สถานะ 2', '3' => 'สถานะ 3', '4' => 'สถานะ 4', '5' => 'สถานะ 5'),
    
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
