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


Route::group(['prefix' => 'admin'], function(){
    Route::get('/', [
        'uses' => 'ManageController@getIndex',
        'as' => 'manage.index',
    ]);

    Route::get('/orders', [
        'uses' => 'ManageController@getIndex',
        'as' => 'manage.index',
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

});


Route::group(['prefix' => 'user'], function() {
    Route::get('/signup',[
        'uses' => 'UserController@getSignup',
        'as' => 'user.signup'
    ]);

    Route::post('/signup',[
        'uses' => 'UserController@postSignup',
        'as' => 'user.signup'
    ]);

    Route::get('/signin',[
        'uses' => 'UserController@getSignin',
        'as' => 'user.signin'
    ]);

    Route::post('/signin',[
        'uses' => 'UserController@postSignin',
        'as' => 'user.signin'
    ]);
    Route::get('/profile',[
        'uses' => 'UserController@getProfile',
        'as' => 'user.profile'
    ]);

    Route::get('/logout', [
        'uses' => 'UserController@getLogout',
        'as' => 'user.logout'
    ]);
});