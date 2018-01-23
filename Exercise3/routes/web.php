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

Route::get('/login', function() {
    return view('content');
});

Route::post('/login', 'UserController@login');

Route::get('/', function() {
    return view('content');
});
Route::get('/view/{view}', 'Controller@getView')->name('view');

Route::get('/angular', function () {
    return view('content');
});

Route::get('/jquery', function() {
    return view('home-jquery');
});

Route::get('/admin/angular', function() {
    return view('content');
});

Route::get('/myaccount', function() {
    return view('content');
});


// Products
Route::get('/products', 'ProductController@get');
Route::post('/add-product', 'ProductController@addProduct');
Route::post('/edit-product', 'ProductController@editProduct');
Route::post('/remove-product', 'ProductController@removeProduct');

// Orders
Route::get('/orders', 'OrderController@get');
Route::post('/submit-order', 'OrderController@submitOrder');
Route::post('/fulfill', 'OrderController@fulfill');
Route::post('/cancel-order', 'OrderController@cancelOrder');

// Users
Route::get('/users', 'UserController@get');
Route::get('/users/{id}', 'UserController@getByUserId');
Route::post('/change-password', 'UserController@changePassword');
Route::post('/edit-user', 'UserController@editUser');
Route::post('/add-user', 'UserController@addUser');
Route::post('/delete-user', 'UserController@deleteUser');
