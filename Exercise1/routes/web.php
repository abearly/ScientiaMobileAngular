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

Route::get('/view/{view}', 'Controller@getView')->name('view');

Route::get('/angular', function () {
    return view('content');
});

Route::get('/jquery', function() {
    return view('home-jquery');
});

Route::get('/', function() {
    return view('welcome');
});
