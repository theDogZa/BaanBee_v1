<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'lock']);
        Cache::flush();
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: text/html');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        return view('dashboard');
    }

    public function datatojs()
    {
    
        $array['icon_title_confirm'] = config('core.icon-js.title_confirm');
        $array['icon_btn_confirm'] = config('core.icon-js.btn_confirm');
        $array['icon_btn_cancel'] = config('core.icon-js.btn_cancel');
      
         //---- noti
        $array['lang_noti_title_update'] = __("core.update_title");
        $array['lang_noti_update_success'] = __("core.update_success");
        $array['lang_noti_update_error'] = __("core.update_error");

        $array['lang_noti_title_del'] = __("core.del_title");
        $array['lang_noti_del_success'] = __("core.del_success");
        $array['lang_noti_del_error'] = __("core.del_error");
      
        $array['lang_search_success'] = __("core.search_success");
        $array['lang_adv_search_success'] = __("core.adv_search_success");

        $array['lang_noti_search_title'] = __("core.noti_search_title");
        $array['lang_noti_adv_search_title'] = __("core.noti_adv_search_title");
        $array['lang_noti_title_success'] = __("core.noti_title_success");
        $array['lang_noti_title_error'] = __("core.noti_title_error");

        $array['lang_noti_title_data_not_change'] = __("core.data_not_change_title");
        $array['lang_noti_data_not_change'] = __("core.data_not_change_message");

        //---- confirm
        $array['lang_confirm_title'] = __("core.confirm_title");      
        $array['lang_confirm_title_edit'] = __("core.confirm_title_edit");
        $array['lang_confirm_edit'] = __("core.confirm_edit");
        $array['lang_confirm_title_del'] = __("core.confirm_title_del");
        $array['lang_confirm_del'] = __("core.confirm_del");
        $array['lang_confirm_title_logout'] = __("core.confirm_title_logout");
        $array['lang_confirm_logout'] = __("core.confirm_logout");

        //---- progress
        $array['lang_progress_message'] = __("core.progress_message");
        $array['lang_progress_message_done'] = __("core.progress_message_done");
        $array['lang_progress_message_complete'] = __("core.progress_message_complete");

        return  json_encode($array);
        //return $array;
    }
}



/** 
 * 
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 18/04/2018 23:40
 * Version : v.10000
 */
