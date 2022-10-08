<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Auth_menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        view()->composer(['*'], function ($view) {
        // if (Auth::check()) {
                $menus = Auth_menu::where('active','=','1')->orderBy('menu_sort')->get();
               // $menus = Menu::all();
           
        //  }
            $view->with('menu', $menus);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}




/** 
 *
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 14/04/2018 23:40
 * Version : v.10000
 *
 */
