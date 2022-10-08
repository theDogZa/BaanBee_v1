<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

use App;
use App\Models;
use App\Models\User;
use Session;
use Cache;

use DB;

class ProfilesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Change Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling change password requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
     */
    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('auth');

        Cache::flush();
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: text/html');

        $this->arrShowFieldView = [
            'name' => 1, 'username' => 1, 'email' => 1, 'password' => 0, 'status' => 1, 'remember_token' => 0,
        ];
        $this->arrstatus = ['1', '2'];
    }

    public function index()
    {
        $id = Auth::id();
        $user = User::select()->findOrFail($id);
        $compact['results'] = $user;
        $compact['arrShowFieldView'] = $this->arrShowFieldView;

        $compact['arrstatus'] = $this->arrstatus;

        return view('profiles.index', $compact);
    }



    public function changePassword(Request $request)
    {
        
        $compact = array();
        return view('auth.passwords.change', $compact);
    }

    public function checkPassword(Request $request)
    {

        $cur_password = $request->input('cur_password');

        $id = Auth::id();
        $user = User::select('password')->findOrFail($id);

        if (password_verify($cur_password, $user->password)) {
            return true;
        } else {
            return 'false';
        }   
    }

    public function updatePassword(Request $request)
    {
        DB::beginTransaction();

        $input['password'] = bcrypt($request->input('new_password'));
        $input['updated_uid'] = Auth::id();

        $user = User::findOrFail(Auth::id());
        $results = $user->update($input);

        if ($results) {
            $message = __('core.update_success');
            $status = 'success';
            DB::commit();
        } else {
            $message = __('core.update_success');
            $status = 'error';
            DB::rollBack();
        }

        Auth::logout();

        Session::flash('message', $message);
        Session::flash('status', $status);

        return redirect('/login');
    }
}



/** 
 * 
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 11/04/2018 22:43
 * Version : v.10000
 */