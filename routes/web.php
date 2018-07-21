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

Route::get('/', [
    'uses' => 'ProductController@getIndex',
    'as' => 'product.index',
]);

Route::post('/', [
    'uses' => 'ProductController@postIndex',
    'as' => 'product.index',
]);

Route::get('/ajax/check', [
   'uses' => 'AjaxController@getBread',
   'as' => 'ajax.bread',
]);

Route::post('ajaxdata/postdata', [
    'uses' => 'AjaxController@postdata',
    'as' => 'ajaxdata.postdata'
]);


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::auth();
    Route::get('/', [
        'uses' => 'ManageController@getIndex',
        'as' => 'manage.index',
    ]);

    Route::get('/orders', [
        'uses' => 'ManageController@getIndex',
        'as' => 'manage.index',
    ]);

    Route::get('/orders/edit/{id}', [
        'uses' => 'ManageController@editOrder',
        'as' => 'manage.editOrder',
    ]);

    Route::post('/orders/edit', [
        'uses' => 'ManageController@postEditOrder',
        'as' => 'manage.postEditOrder',
    ]);

    Route::get('/orders/delete/{id}', [
        'uses' => 'ManageController@destroyOrder',
        'as' => 'manage.destroyOrder',
    ]);

    Route::get('/product', [
        'uses' => 'ManageController@getProduct',
        'as' => 'manage.products',
    ]);

    Route::get('/product/new', [
        'uses' => 'ManageController@addProduct',
        'as' => 'manage.addProduct',
    ]);

    Route::post('/product/new', [
        'uses' => 'ManageController@postAddProduct',
        'as' => 'manage.addProduct',
    ]);

    Route::get('/product/edit/{id}', [
        'uses' => 'ManageController@editProduct',
        'as' => 'manage.editProduct',
    ]);

    Route::post('/product/edit', [
        'uses' => 'ManageController@postEditProduct',
        'as' => 'manage.postEditProduct',
    ]);

    Route::get('/product/delete/{id}', [
        'uses' => 'ManageController@destroyProduct',
        'as' => 'manage.destroyProduct',
    ]);

    Route::get('/holiday', [
        'uses' => 'ManageController@getHoliday',
        'as' => 'manage.holidays',
    ]);

    Route::get('/holiday/delete/{id}', [
        'uses' => 'ManageController@destroyHoliday',
        'as' => 'manage.destroyHoliday',
    ]);

    Route::get('/bulletin', [
        'uses' => 'ManageController@getBulletin',
        'as' => 'manage.bulletin',
    ]);

    Route::post('/bulletin', [
       'uses' => 'ManageController@postBulletin',
       'as' => 'manage.bulletin',
    ]);

    Route::get('/spot', [
        'uses' => 'ManageController@getSpot',
        'as' => 'manage.spots',
    ]);

    Route::get('/spot/new', [
        'uses' => 'ManageController@addSpot',
        'as' => 'manage.addSpot',
    ]);

    Route::post('/spot/new', [
        'uses' => 'ManageController@postAddSpot',
        'as' => 'manage.addSpot',
    ]);

    Route::get('/spot/edit/{id}', [
        'uses' => 'ManageController@editSpot',
        'as' => 'manage.editSpot',
    ]);

    Route::post('/spot/edit', [
        'uses' => 'ManageController@postEditSpot',
        'as' => 'manage.postEditSpot',
    ]);

    Route::get('/spot/delete/{id}', [
        'uses' => 'ManageController@destroySpot',
        'as' => 'manage.destroySpot',
    ]);

});


Route::group(['prefix' => 'user'], function() {
//    Route::get('/signup',[
//        'uses' => 'UserController@getSignup',
//        'as' => 'user.signup'
//    ]);
//
//    Route::post('/signup',[
//        'uses' => 'UserController@postSignup',
//        'as' => 'user.signup'
//    ]);
//
//    Route::get('/signin',[
//        'uses' => 'UserController@getSignin',
//        'as' => 'user.signin'
//    ]);
//
//    Route::post('/signin',[
//        'uses' => 'UserController@postSignin',
//        'as' => 'user.signin'
//    ]);
//    Route::get('/profile',[
//        'uses' => 'UserController@getProfile',
//        'as' => 'user.profile'
//    ]);

    Route::get('/logout', [
        'uses' => 'UserController@getLogout',
        'as' => 'user.logout'
    ]);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');