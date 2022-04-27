<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...
    });
  */
Route::group([ 'namespace'=> 'Admin' , 'middleware' => 'auth:admin'],function(){

    Route::get('/','DashboardController@index')->name('admin.dashboard');
    Route::get('logout','LoginController@logout')->name('admin.logout');

    Route::group(['prefix'=> 'settings'], function(){
       Route::get('shipping_method/{type}','SeetingController@editShippingMethods')->name('shipping_method');
       Route::put('shipping_method/{id}','SeetingController@updateShippingMethods')->name('update.shippings.methods');

    });
    Route::group(['prefix'=> 'profile'], function(){
        Route::get('edit','ProfileController@edit')->name('profile.edit');
        Route::put('update','ProfileController@update')->name('profile.update');

    });
    ///////////////////////////Routes categories

   Route::group(['prefix' => 'main_categories'], function () {
    Route::get('/', 'CategoryController@index')->name('admin.maincategories');
    Route::get('create', 'CategoryController@create')->name('admin.maincategories.create');
    Route::post('store', 'CategoryController@store')->name('admin.maincategories.store');
    Route::get('edit/{id}', 'CategoryController@edit')->name('admin.maincategories.edit');
    Route::post('update/{id}', 'CategoryController@update')->name('admin.maincategories.update');
    Route::get('delete/{id}', 'CategoryController@destroy')->name('admin.maincategories.delete');
});
    /////////////////////////end categories

});
Route::group([ 'namespace'=> 'Admin' , 'middelware'=>'guest:admin'],function(){

    Route::get('/login','LoginController@login')->name('admin.login');
    Route::post('/login','LoginController@postLogin')->name('admin.post.login');
});
