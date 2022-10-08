<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use Cache;
//use App\Models\Menu;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
    * Get the needed authorization credentials from the request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array
    */
   protected function credentials(Request $request)
   {
       $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
           ? $this->username()
           : 'username';

       return [
            $field => $request->get($this->username()),
            'password' => $request->password,
            // 'status' => 1
       ];
   }

    protected function authenticated(Request $request, $user)
    {

        //$menus = Menu::where('id', '!=', null)->orderBy('menu_sort');
        //dd($menu);
       // $request->session()->put('menus', $menus);
        Session::flash('title', __('core.login_title'));
        Session::flash('message', __('core.login_message_success',['username'=> $user->username ]));
        Session::flash('status', 'success');
      
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        Cache::flush();
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: text/html');

        Session::flash('title', __('core.logout_title'));
        Session::flash('message', __('core.logout_message_success'));
        Session::flash('status', 'success');
        return redirect('/login');
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {

        Session::flash('title', __('core.login_title'));
        Session::flash('message', __('core.login_message_error'));
        Session::flash('status', 'warning');
        return redirect('/login');
    }

    protected function sendLoginResponse(Request $request)
    {
        if ($this->guard()->user()->active == 0) {
            Session::flash('title', __('core.login_title'));
            Session::flash('message', __('core.login_message_not_active', ['username' => $this->guard()->user()->username]));
            Session::flash('status', 'error');
            $this->guard()->logout();
            return redirect()->back();      
        }

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ? : redirect()->intended($this->redirectPath());
    }
}



/** 
 * 
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 14/04/2018 01:23
 * Version : v.10000
 */
