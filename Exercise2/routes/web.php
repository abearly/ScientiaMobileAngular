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

Route::get('/', function() {
    return view('welcome');
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

Route::get('/products', 'Controller@mockApi');
Route::get('/orders', 'Controller@getOrders');
Route::post('/add-product', 'Controller@addProduct');
Route::post('/edit-product', 'Controller@editProduct');
Route::post('/remove-product', 'Controller@removeProduct');
Route::post('/submit-order', 'Controller@submitOrder');
