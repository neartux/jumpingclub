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

    Route::get('/product/findProductTypes', 'ProductController@findProductTypes');

    Route::get('/product/findProductsByType/{productTypeId}', 'ProductController@findProductsByType');

    Route::post('/product/createProduct', 'ProductController@createProduct');

    Route::post('/product/updateProduct', 'ProductController@updateProduct');

    Route::post('/product/publicProduct', 'ProductController@publicProduct');

    Route::get('/product/deleteProduct/{id}', 'ProductController@deleteProduct');

    Route::get('/product/findImagesByProduct/{id}', 'ProductController@findImagesByProduct');

    Route::get('/product/setMainImageByProduct/{imageId}/{productId}', 'ProductController@setMainImageByProduct');

    Route::get('/product/deleteImage/{imageId}', 'ProductController@deleteImage');

    Route::post('/product/uploadimages', 'ProductController@uploadImages')->name('admin_product_upload_image');
    
});
