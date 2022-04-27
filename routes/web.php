<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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




Route::get('login','AuthController@login')->name('login');
Route::post('/dologin','AuthController@dologin')->name('dologin');
Route::post('/doregister','AuthController@doregister')->name('doregister');
Route::get('logout','AuthController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/','AuthController@home')->name('home');
    Route::get('products','AuthController@products')->name('products');
    Route::get('adminHome','AuthController@adminHome')->name('adminHome');
    Route::post('addProduct','AuthController@addProduct')->name('addProduct');
    Route::post('/editProduct','AuthController@editProduct')->name('editProduct');
    Route::post('/deleteProduct','AuthController@deleteProduct')->name('deleteProduct');
});