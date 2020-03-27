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

Route::prefix('admin')->group(function(){
    Route::get('/login', 'AdminController@showLoginForm')->name('admin.loginForm')->middleware('guest:admin');
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard')->middleware('auth:admin');
    Route::get('/product', 'AdminController@product')->name('admin.product')->middleware('auth:admin');
    Route::get('/users', 'AdminController@users')->name('admin.users')->middleware('auth:admin');
    Route::get('/transaction', 'AdminController@transaction')->name('admin.transaction')->middleware('auth:admin');
    Route::get('/product_categories', 'AdminController@product_categories')->name('admin.product_categories')->middleware('auth:admin');
    Route::get('/courier', 'AdminController@courier')->name('admin.courier')->middleware('auth:admin');

    Route::get('/logout', 'AdminController@logout')->name('admin.logout')->middleware('auth:admin');

    Route::post('/login', 'AdminController@loginAdmin')->name('admin.login');

});



