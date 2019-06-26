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



Route::get('/', function () {
    return '<hr> You should read <a href="https://github.com/gabrieldarezzo/mobly-private/">README.md</a>, make with S2';
});



Route::get('user/new', 'UserController@new');
Route::resource('users', 'UserController');

// Route::resource('address', 'AddressController');
// Route::resource('company', 'CompanyController');
// Route::resource('posts', 'PostController');