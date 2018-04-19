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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function()  {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/product/list', 'ProductController@productList')->name('admin_product_list');

    Route::post('/product/uploadimages', 'ProductController@uploadImages')->name('admin_product_upload_image');
    
});