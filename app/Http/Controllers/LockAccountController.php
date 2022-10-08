<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Cache;

class LockAccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        Cache::flush();
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: text/html');
    }

    public function lockscreen(Request $request)
    {
      
        if(!$request->session()->get('locked')){
            session(['locked' => 'true', 'uri' => url()->previous()]);     
        }
       
            return view('auth.lockscreen');
      
    }

    public function unlock(Request $request)
    {

        $password = $request->password;

        $this->validate($request, [
            'password' => 'required|string',
        ]);

        if(\Hash::check($password, \Auth::user()->password)){
    
            $uri = $request->session()->get('uri');
            $request->session()->forget(['locked', 'uri']);

            Session::flash('title', __('core.login_title'));
            Session::flash('message', __('core.login_message_success', ['username' => auth()->user()->name]));
            Session::flash('status', 'success');
            return redirect($uri);
        }

        Session::flash('title', __('core.login_title'));
        Session::flash('message', __('core.login_message_error'));
        Session::flash('status', 'warning');

        return back();
    }
}



/** 
 * 
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 11/04/2018 22:48
 * Version : v.10000
 */