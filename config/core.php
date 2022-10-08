<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */
    'icon-app' => env('APP_ICON', '<i class="fa fa-paw"></i>'),

    /* format Date Time */
    'date-default-format' => 'd/m/Y',
    // 'date-format' => 'd F Y',
    // 'datetime-format' => 'd F Y H:i',
    // 'time-format' => 'H:i',
    'date-format' => 'd/m/Y',
    'datetime-format' => 'd/m/Y H:i',
    'time-format' => 'H:i',

    /* format Date Time JS*/
    'date-default-format-js' => 'dd/mm/yyyy',
    'date-format-js' => 'dd/mm/yyyy',
    'datetime-format-js' => 'dd/mm/yyyy hh:ii',
    'time-format-js' => 'hh:ii',

   /* paginate */
    'paginate' => '20',

     /* str */
    'textarea_limit' => '60',
    'textarea_end_str' => '...',

    /** icon  */
    'icon' => [
        'breadcrumb_home' => '<i class="fa fa-home"></i> ',
        'title_list' => '<i class="fa fa-list-alt" aria-hidden="true"></i>',
        'title_advanced_search' => '<i class="fa fa-search-plus" aria-hidden="true"></i>',
        'title_from' => '<i class="fa fa-pencil" aria-hidden="true"></i>',
        'title_view' => '<i class="fa fa-eye" aria-hidden="true"></i>',
        'btn_add' => '<i class ="fa fa-plus-circle" aria-hidden = "true"></i>',
        'btn_edit' => '<i class="fa fa-pencil" aria-hidden="true"></i>',
        'btn_view' => '<i class="fa fa-eye" aria-hidden="true"></i>',
        'btn_del' => '<i class="fa fa-trash" aria-hidden="true"></i>',
        'btn_back' => '<i class="fa fa-arrow-left" aria-hidden="true"></i> ',
        'btn_save' => '<i class="fa fa-floppy-o" aria-hidden="true"></i>',
        'btn_save_draft' => '<i class="fa fa-clipboard" aria-hidden="true"></i>',
        'btn_reset' => '<i class="fa fa-eraser" aria-hidden="true"></i>',
        'btn_search' => '<i class="fa fa-search" aria-hidden="true"></i> ',
        'btn_advanced_search_open' => '<i class="fa fa-search-plus" aria-hidden="true"></i>',
        'btn_unlock_screen' => '<i class="fa fa-arrow-right"></i>',
        'btn_profile' => '<i class="fa fa-user-secret pull-right"></i>',
        'btn_change_password' => '<i class="fa fa-key pull-right"></i>',
        'btn_logout' => '<i class="fa fa-sign-out pull-right"></i>',
        'btn_login' => '<i class="fa fa-sign-in"></i>',
        'addon_date' => '<span class="glyphicon glyphicon-calendar"></span>',
        'addon_time' => '<span class="glyphicon glyphicon-time"></span>',
        'addon_datetime' => '<span class="glyphicon glyphicon-calendar"></span>',
    ],

    'icon-js' => [
        'title_confirm' => '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>',
        'btn_confirm' => '<i class="fa fa-check" aria-hidden="true"></i>',
        'btn_cancel' => '<i class="fa fa-times" aria-hidden="true"></i>',
    ],

    /** Path Folder  */
    'folder' => [
        'profile_img' => '/images/profiles/',  
    ],

    /** image temp  */
    'imagetemp' => [
        'profile' => 'temp-user-profile.png',
    ],

    /** app module  */
    'module' => [
        'itmes' => true,
        'warehouses' => true,    
    ],

    /** layout  */
    /**
     * -- class from bootstrap
     * -- ******************** box need form-group
     * 
     * EX. form line
     * 'add' => 
     *       'box' => ' form-group',
     *       'label' => 'col-lg-3 control-label',
     *       'input'=> 'col-lg-6 col-md-6 col-sm-6 col-xs-12',   
     *       'button' => 'col-sm-offset-3 col-sm-6'
     *   
     * EX. form col
     * 'add' => 
     *       'box' => 'col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group',
     *       'label' => 'control-label',
     *       'input'=> '',  
     *       'button' => 'col-sm-12 pull-right' 
     *   
     */

    'layout' => [
        'form' => [
            'add' => [
                'box' => 'col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group',
                'label' => 'control-label',
                'input'=> '',
                'button' => ''
            ],
            'view' => [
                'box' => 'col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group',
                'label' => 'control-label',
                'input' => '',
                'button' => ''
            ],
            'search' => [
                'box' => 'col-lg-4 col-md-6 col-sm-6 col-xs-12 form-group',
                'label' => 'control-label',
                'input' => '',
                'button' => 'form-group pull-right'
            ],
        ],

        'button' => [
            'add' => 'btn-primary"',
            'edit' => 'btn-success',
            'view' => 'btn-info',
            'submit' => 'btn-success',
            'reset' => 'btn-warning',
            'back' => 'btn-default',
            'del' => 'btn-danger',
            'search' => 'btn-info',
            'size' => 'btn-sm',
        ],

        'input' => [
            'textarea' => [
                'rows' => 3
            ],
        ]
    ],

];




/** 
 *
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 24/07/2018 09:13
 * Version : v.10000
 *
 */

