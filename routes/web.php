<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', 'HomeController@dashboard')->name('dashboard');

Route::get('/login','UserController@login')->name('user.login')->middleware('guest');
Route::get('/register','UserController@regis')->name('user.regis')->middleware('guest');

Route::get('user/{token}', 'UserController@verify')->name('user.verify');
Route::post('/register', 'UserController@regisUser')->name('user.regisUser')->middleware('guest');

Route::get('/logout', 'UserController@logout')->name('logout');
Route::post('/login', 'UserController@loginUser')->name('user.loginUser');

Route::prefix('admin/courier')->group(function(){
    Route::get('/', 'CourierController@index')->name('admin.courier')->middleware('auth:admin');
    Route::get('/add', 'CourierController@create')->name('courier.add')->middleware('auth:admin');
    Route::get('/{id}/edit', 'CourierController@edit')->name('courier.edit')->middleware('auth:admin');
    Route::post('/store', 'CourierController@store')->name('courier.store')->middleware('auth:admin');
    Route::post('/{id}/update', 'CourierController@update')->name('courier.update')->middleware('auth:admin');
    Route::delete('/{id}', 'CourierController@destroy')->name('courier.destroy')->middleware('auth:admin');

});

Route::prefix('admin/product')->group(function(){
    Route::get('/', 'ProductController@index')->name('admin.product')->middleware('auth:admin');
    Route::get('/add', 'ProductController@create')->name('product.add')->middleware('auth:admin');
    Route::get('/{id}/edit', 'ProductController@edit')->name('product.edit')->middleware('auth:admin');
    Route::post('/store', 'ProductController@store')->name('product.store')->middleware('auth:admin');
    Route::post('/{id}/edit', 'ProductController@update')->name('product.edit')->middleware('auth:admin');
    Route::delete('/{id}', 'ProductController@destroy')->name('product.destroy')->middleware('auth:admin');

});

Route::prefix('admin/category')->group(function(){
    Route::get('/', 'ProductCategoriesController@index')->name('admin.category')->middleware('auth:admin');
    Route::get('/add', 'ProductCategoriesController@create')->name('category.add')->middleware('auth:admin');
    Route::get('/{id}/edit', 'ProductCategoriesController@edit')->name('category.edit')->middleware('auth:admin');
    Route::post('/store', 'ProductCategoriesController@store')->name('category.store')->middleware('auth:admin');
    Route::post('/{id}/edit', 'ProductCategoriesController@update')->name('category.edit')->middleware('auth:admin');
    Route::delete('/{id}', 'ProductCategoriesController@destroy')->name('category.destroy')->middleware('auth:admin');

});

Route::prefix('admin')->group(function(){
    Route::get('/login', 'AdminController@showLoginForm')->name('admin.loginForm')->middleware('guest:admin');
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard')->middleware('auth:admin');
    
    Route::get('/users', 'AdminController@users')->name('admin.users')->middleware('auth:admin');
    Route::get('/transaction', 'AdminController@transaction')->name('admin.transaction')->middleware('auth:admin');

    /*Route::get('/addcourier', function(){
        return view('CreateController', compact('courier'));
    });*/
    

    Route::get('/logout', 'AdminController@logout')->name('admin.logout')->middleware('auth:admin');

    Route::post('/login', 'AdminController@loginAdmin')->name('admin.login');

});


