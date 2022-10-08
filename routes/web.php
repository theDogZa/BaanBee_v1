<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::group(['middleware'=>'auth'], function (){
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('dashboard', 'HomeController@index')->name('dashboard');

    Route::get('/item_types/checkCode/{id?}', 'Item_typesController@checkCode')->name('checkCode');
    Route::get('/item_categories/checkCode/{id?}', 'Item_categoriesController@checkCode')->name('checkCode');
    Route::get('/item_sizes/checkCode/{id?}', 'Item_sizesController@checkCode')->name('checkCode');
    Route::get('/item_colors/checkCode/{id?}', 'Item_colorsController@checkCode')->name('checkCode');
    Route::get('/item_adjusted_types/checkCode/{id?}', 'Item_adjusted_typesController@checkCode')->name('checkCode');
    Route::get('/items/genItemCode/{id?}', 'ItemsController@genItemCode')->name('genItemCode');
    Route::get('/items/ajaxGetItemList/{id?}', 'ItemsController@_ajaxGetItemList')->name('ajaxGetItemList');

    Route::resource('/profiles', 'ProfilesController');
    Route::resource('/users', 'UsersController');
    Route::resource('/examples', 'ExamplesController');
    Route::resource('/menus', 'Auth_menusesController');
    Route::resource('/item_types', 'Item_typesController');
    Route::resource('/item_colors', 'Item_colorsController');
    Route::resource('/item_sizes', 'Item_sizesController');
    Route::resource('/item_units', 'Item_unitsController');
    Route::resource('/item_categories', 'Item_categoriesController');
    Route::resource('/items', 'ItemsController');
    Route::resource('/warehouses', 'WarehousesController');
    Route::resource('/warehouse_items', 'Warehouse_itemsController');
    Route::resource('/item_adjusted_types', 'Item_adjusted_typesController');
    Route::resource('/item_adjusteds', 'Item_adjustedsController');
    Route::get('/home/datatojs', 'HomeController@datatojs');
    Route::get('changePassword', 'ProfilesController@changePassword')->name('changePassword');
    Route::get('checkPassword', 'ProfilesController@checkPassword')->name('checkPassword');
    Route::post('updatePassword', 'ProfilesController@updatePassword')->name('updatePassword');

    Route::get('checkUsername/{id}', 'UsersController@checkUsername')->name('checkUsername');
    Route::get('checkEmail/{id}', 'UsersController@checkEmail')->name('checkEmail');

    Route::get('lockscreen', 'LockAccountController@lockscreen')->name('lockscreen');
    Route::post('lockscreen', 'LockAccountController@unlock');
  
});




/** 

 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 15/04/2018 03:21
 * Version : v.10000
 *

 */