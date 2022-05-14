<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('verfied', function () {
    return view('auth.verification');
});

Route::get('/', function () {
    return view('front.home');
})->name('home');

Route::group([ 'namespace'=> 'site' , 'middleware' =>[ 'auth','verfiedUser']],function(){


    Route::get('profile',function(){
       return 'you are Auth';
    });

});

Route::group([ 'namespace'=> 'Auth' , 'middleware' =>'auth'],function(){


    Route::post('verify-user','VerifyUserController@verfiy')->name('verify-user');

});



Route::group([ 'namespace'=> 'site' , 'middleware' => 'guest'],function(){
    ////

    });

