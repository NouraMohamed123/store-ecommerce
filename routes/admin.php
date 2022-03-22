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

    Route::group(['prefix'=> 'settings'], function(){
       Route::get('shipping_method/{type}','SeetingController@editShippingMethods')->name('shipping_method');
       Route::post('shipping_method/{id}','SeetingController@updateShippingMethods')->name('update_shipping_method');
    });


});

Route::group([ 'namespace'=> 'Admin' , 'middelware'=>'guest:admin'],function(){

    Route::get('/login','LoginController@login')->name('admin.login');
    Route::post('/login','LoginController@postLogin')->name('admin.post.login');
});
