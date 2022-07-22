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
    ///////////////////////////Routes main categories

   Route::group(['prefix' => 'main_categories'], function () {
    Route::get('/', 'CategoryController@index')->name('admin.maincategories');
    Route::get('create', 'CategoryController@create')->name('admin.maincategories.create');
    Route::post('store', 'CategoryController@store')->name('admin.maincategories.store');
    Route::get('edit/{id}', 'CategoryController@edit')->name('admin.maincategories.edit');
    Route::post('update/{id}', 'CategoryController@update')->name('admin.maincategories.update');
    Route::get('delete/{id}', 'CategoryController@destroy')->name('admin.maincategories.delete');
});
    /////////////////////////end main categories
      ///////////////////////////Routes sub categories

   Route::group(['prefix' => 'sub_categories'], function () {
    Route::get('/', 'SubCategoryController@index')->name('admin.subcategories');
    Route::get('create', 'SubCategoryController@create')->name('admin.subcategories.create');
    Route::post('store', 'SubCategoryController@store')->name('admin.subcategories.store');
    Route::get('edit/{id}', 'SubCategoryController@edit')->name('admin.subcategories.edit');
    Route::post('update/{id}', 'SubCategoryController@update')->name('admin.subcategories.update');
    Route::get('delete/{id}', 'SubCategoryController@destroy')->name('admin.subcategories.delete');
});
    /////////////////////////end sub categories

    ///brands

   Route::group(['prefix' => 'brand'], function () {
    Route::get('/', 'BrandController@index')->name('admin.brand');
    Route::get('create', 'BrandController@create')->name('admin.brand.create');
    Route::post('store', 'BrandController@store')->name('admin.brand.store');
    Route::get('edit/{id}', 'BrandController@edit')->name('admin.brand.edit');
    Route::post('update/{id}', 'BrandController@update')->name('admin.brand.update');
    Route::get('delete/{id}', 'BrandController@destroy')->name('admin.brand.delete');
});
    /////////////////////////end brand

  ///brands

  Route::group(['prefix' => 'tag'], function () {
    Route::get('/', 'TagController@index')->name('admin.tag');
    Route::get('create', 'TagController@create')->name('admin.tag.create');
    Route::post('store', 'TagController@store')->name('admin.tag.store');
    Route::get('edit/{id}', 'TagController@edit')->name('admin.tag.edit');
    Route::post('update/{id}', 'TagController@update')->name('admin.tag.update');
    Route::get('delete/{id}', 'TagController@destroy')->name('admin.tag.delete');
});
///////////////////////end tag

    ///brands

    Route::group(['prefix' => 'product'], function () {
        Route::get('/', 'ProductController@index')->name('admin.products.general');
        Route::get('create', 'ProductController@create')->name('admin.products.general.create');
        Route::post('store', 'ProductController@store')->name('admin.products.general.store');
        Route::get('edit/{id}', 'ProductController@edit')->name('admin.products.general.edit');
        Route::post('update/{id}', 'ProductController@update')->name('admin.products.general.update');
        Route::get('delete/{id}', 'ProductController@destroy')->name('admin.products.general.delete');
    });
    Route::get('price/{id}', 'ProductController@getPrice')->name('admin.products.price');
    Route::post('price', 'ProductController@saveProductPrice')->name('admin.products.price.store');
        /////////////////////////end product
    Route::get('stock/{id}', 'ProductController@getstock')->name('admin.products.stock');
    Route::post('stock', 'ProductController@saveProductstock')->name('admin.products.stock.store');
        /////////////////////////end product
        Route::get('image/{id}', 'ProductController@getimage')->name('admin.products.images');
        Route::post('image', 'ProductController@saveProductimage')->name('admin.products.images.store');
            /////////////////////////end product
              ################################## attrributes routes ######################################
        Route::group(['prefix' => 'attributes'], function () {
            Route::get('/', 'AttributeController@index')->name('admin.attributes');
            Route::get('create', 'AttributeController@create')->name('admin.attributes.create');
            Route::post('store', 'AttributeController@store')->name('admin.attributes.store');
            Route::get('delete/{id}', 'AttributeController@destroy')->name('admin.attributes.delete');
            Route::get('edit/{id}', 'AttributeController@edit')->name('admin.attributes.edit');
            Route::post('update/{id}', 'AttributeController@update')->name('admin.attributes.update');
        });
        ################################## end attributes    #######################################

        ################################## brands options ######################################
        Route::group(['prefix' => 'options'], function () {
            Route::get('/', 'OptionController@index')->name('admin.options');
            Route::get('create', 'OptionController@create')->name('admin.options.create');
            Route::post('store', 'OptionController@store')->name('admin.options.store');
            Route::get('delete/{id}','OptionController@destroy') -> name('admin.options.delete');
            Route::get('edit/{id}', 'OptionController@edit')->name('admin.options.edit');
            Route::post('update/{id}', 'OptionController@update')->name('admin.options.update');
        });
        ################################## end options    #######################################
        Route::group(['prefix' => 'sliders'], function () {
            Route::get('/', 'SliderController@addImages')->name('admin.sliders.create');
            Route::post('images', 'SliderController@saveSliderImages')->name('admin.sliders.images.store');


        });
});
Route::group([ 'namespace'=> 'Admin' , 'middelware'=>'guest:admin'],function(){

    Route::get('/login','LoginController@login')->name('admin.login');
    Route::post('/login','LoginController@postLogin')->name('admin.post.login');
});
