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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//verifikasi email user
//Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminpageController@index')->name('admin');
Route::get('/user', 'UserpageController@index')->name('user');

Route::get('/commonerror', 'ErrorController@index')->name('commonerror');
Route::get('/activationerror', 'ErrorController@activationerror')->name('activationerror');
Route::get('/notauthorized', 'ErrorController@notauthorized')->name('notauthorized');
