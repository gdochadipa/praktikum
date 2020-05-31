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
Route::get('/province', 'HomeController@getProvince')->name('province');
Route::get('/city', 'HomeController@getCity')->name('city');
Route::get('/notify', 'HomeController@notify')->name('notify');
Route::get('/markAsRead', 'HomeController@markAsRead')->name('markAsRead');
Route::prefix('product')->group(function () {
    Route::get('/{id}', 'HomeController@detail_product')->name('detail_product');
    Route::post('review/{id}', 'HomeController@review_product')->name('review_product');
});
 
Route::prefix('carts')->group(function () {
    Route::get('/', 'CartsController@index')->name('user.carts');
    Route::post('/update', 'CartsController@update_carts')->name('user.carts.update');
    Route::post('/store', 'CartsController@store')->name('user.carts.store');
    Route::delete('/{id}', 'CartsController@delete')->name('user.carts.delete');
});

Route::prefix('/user/transaction')->group(function () {
    Route::get('/history', 'TransactionController@history')->name('user.transaction.history');
    Route::get('/confirm/{id}', 'TransactionController@showConfirmation')->name('user.transaction.showConfirmation');
    Route::get('/check', 'TransactionController@check')->name('user.transaction.check');
    Route::post('/courier', 'TransactionController@courierPilih')->name('user.transaction.courierPilih');
    Route::post('/purchase', 'TransactionController@purchase')->name('user.transaction.purchase');
    Route::post('/proof/{id}', 'TransactionController@proof')->name('user.transaction.proof');

});

Route::prefix('transaction')->group(function () {
    Route::get('/', 'TransactionController@index')->name('user.transaction');
    Route::post('/add', 'TransactionController@add')->name('user.transaction.add');
   
});


Route::get('/login','UserController@login')->name('user.login')->middleware('guest');
Route::get('/register','UserController@regis')->name('user.regis')->middleware('guest');

Route::get('user/{token}', 'UserController@verify')->name('user.verify');
Route::get('resetToken/{token}', 'UserController@reset')->name('user.token')->middleware('guest');
Route::post('/register', 'UserController@regisUser')->name('user.regisUser')->middleware('guest');

Route::get('/forget', 'UserController@forget')->name('user.forget')->middleware('guest');
Route::get('/reset', 'UserController@reset')->name('user.reset')->middleware('guest');
Route::post('/resetPass/{id}', 'UserController@resetPass')->name('user.resetPass')->middleware('guest');
Route::post('/forgetpass', 'UserController@forgetPass')->name('user.forgetPass')->middleware('guest');

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

    Route::post('/{id}/add_image', 'ProductController@add_image')->name('product.add_image')->middleware('auth:admin');
    Route::delete('/{id}/delete_image', 'ProductController@delete_image')->name('product.delete_image')->middleware('auth:admin');
    Route::post('/{id}/add_cat', 'ProductController@add_cat')->name('product.add_cat')->middleware('auth:admin');
    Route::delete('/{id}/delete_cat', 'ProductController@delete_cat')->name('product.delete_cat')->middleware('auth:admin');
});

Route::prefix('admin/category')->group(function(){
    Route::get('/', 'ProductCategoriesController@index')->name('admin.category')->middleware('auth:admin');
    Route::get('/add', 'ProductCategoriesController@create')->name('category.add')->middleware('auth:admin');
    Route::get('/{id}/edit', 'ProductCategoriesController@edit')->name('category.edit')->middleware('auth:admin');
    Route::post('/store', 'ProductCategoriesController@store')->name('category.store')->middleware('auth:admin');
    Route::post('/{id}/edit', 'ProductCategoriesController@update')->name('category.edit')->middleware('auth:admin');
    Route::delete('/{id}', 'ProductCategoriesController@destroy')->name('category.destroy')->middleware('auth:admin');

});

Route::prefix('admin/review')->group(function () {
    Route::get('/', 'ProductReviewController@index')->name('admin.review')->middleware('auth:admin');
    Route::get('/add', 'ProductReviewController@create')->name('review.add')->middleware('auth:admin');
    Route::get('/{id}/edit', 'ProductReviewController@edit')->name('review.edit')->middleware('auth:admin');
    Route::post('/store', 'ProductReviewController@store')->name('review.store')->middleware('auth:admin');
    Route::put('/{id}/edit', 'ProductReviewController@update')->name('review.update')->middleware('auth:admin');
    Route::delete('/{id}', 'ProductReviewController@destroy')->name('review.destroy')->middleware('auth:admin');
});

Route::prefix('admin/response')->group(function () {
    Route::get('/', 'ResponseController@index')->name('admin.response')->middleware('auth:admin');
    Route::get('/add', 'ResponseController@create')->name('response.add')->middleware('auth:admin');
    Route::get('/{review}/add', 'ResponseController@add_response')->name('response.add_response')->middleware('auth:admin');
    Route::get('/{response}/edit', 'ResponseController@edit')->name('response.edit')->middleware('auth:admin');
    Route::post('/store', 'ResponseController@store')->name('response.store')->middleware('auth:admin');
    Route::put('/{id}/update', 'ResponseController@update')->name('response.update')->middleware('auth:admin');
    Route::delete('/{id}', 'ResponseController@destroy')->name('response.destroy')->middleware('auth:admin');
});

Route::prefix('admin/discount')->group(function () {
    Route::get('/', 'DiscountController@index')->name('admin.discount')->middleware('auth:admin');
    Route::get('/add/{id}', 'DiscountController@create')->name('discount.add')->middleware('auth:admin');
    Route::get('/{discount}/edit', 'DiscountController@edit')->name('discount.edit')->middleware('auth:admin');
    Route::post('/store', 'DiscountController@store')->name('discount.store')->middleware('auth:admin');
    Route::put('/{id}/update', 'DiscountController@update')->name('discount.update')->middleware('auth:admin');
    Route::delete('/{id}', 'DiscountController@destroy')->name('discount.destroy')->middleware('auth:admin');
});

Route::prefix('admin/users')->group(function () {
    Route::get('/', 'AdminController@user')->name('admin.users')->middleware('auth:admin');
    Route::get('/{user}/show', 'AdminController@show')->name('admin.users.show')->middleware('auth:admin');
    Route::put('/{id}/status', 'AdminController@status')->name('admin.users.status')->middleware('auth:admin');
});

Route::prefix('admin/transaction')->group(function () {
    Route::get('/', 'TransactionController@index')->name('admin.transaction')->middleware('auth:admin');
    Route::get('/filter', 'TransactionController@filter')->name('admin.filter')->middleware('auth:admin');
    Route::get('/{transaction}/edit', 'TransactionController@edit_admin')->name('transaction.edit')->middleware('auth:admin');
    Route::get('/{id}/update/{status}', 'TransactionController@update_admin')->name('transaction.update')->middleware('auth:admin');
    Route::delete('/{id}', 'TransactioneController@destroy')->name('transaction.destroy')->middleware('auth:admin');
});

Route::prefix('admin')->group(function(){
    Route::get('/login', 'AdminController@showLoginForm')->name('admin.loginForm')->middleware('guest:admin');
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard')->middleware('auth:admin');
    Route::get('/notify', 'AdminController@notify')->name('admin.notify')->middleware('auth:admin');
    // Route::get('/transaction', 'AdminController@transaction')->name('admin.transaction')->middleware('auth:admin');
    Route::get('/notifyAll', 'AdminController@notifyAll')->name('admin.notifyAll')->middleware('auth:admin');
    /*Route::get('/addcourier', function(){
        return view('CreateController', compact('courier'));
    });*/
    Route::get('markAsRead/', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('admin.markAsRead')->middleware('auth:admin');

    Route::get('markAsReadAll/', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('admin.markAsReadAll')->middleware('auth:admin');

    Route::get('/logout', 'AdminController@logout')->name('admin.logout')->middleware('auth:admin');

    Route::post('/login', 'AdminController@loginAdmin')->name('admin.login');

});


