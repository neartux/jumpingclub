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

    Route::post('/product/createProductType', 'ProductController@createProductType');

    Route::post('/product/updateProduct', 'ProductController@updateProduct');

    Route::post('/product/updateProductType', 'ProductController@updateProductType');

    Route::post('/product/publicProduct', 'ProductController@publicProduct');

    Route::get('/product/deleteProduct/{id}', 'ProductController@deleteProduct');

    Route::get('/product/deleteProductType/{id}', 'ProductController@deleteProductType');

    Route::get('/product/findImagesByProduct/{id}', 'ProductController@findImagesByProduct');

    Route::get('/product/setMainImageByProduct/{imageId}/{productId}', 'ProductController@setMainImageByProduct');

    Route::get('/product/deleteImage/{imageId}', 'ProductController@deleteImage');

    Route::post('/product/uploadimages', 'ProductController@uploadImages')->name('admin_product_upload_image');

    Route::get('/product/changeOrderImage/{imageId}/{order}', 'ProductController@changeOrderImage');

    Route::get('/product/findProductsByCodeOrName', 'ProductController@findProductsByCodeOrName');

    Route::get('/producttype/productTypeList', 'ProductController@productTypeList')->name('admin_categories_list');

    Route::get('/client/list', 'ClientController@clientList')->name('admin_client_list');

    Route::get('/client/findAllClients', 'ClientController@findAllClients');

    Route::post('/client/createClient', 'ClientController@createClient');

    Route::post('/client/updateClient', 'ClientController@updateClient');

    Route::get('/client/delete/{id}', 'ClientController@deleteClient');

    Route::get('/client/findClientById/{clientId}', 'ClientController@findClientById');

    Route::get('/reservation/list', 'ReservationController@reservationList')->name('admin_reservation_list');

    Route::post('/reservation/findAllReservation', 'ReservationController@findAllReservation');

    Route::get('/reservation/findClientByNameOrLastName', 'ReservationController@findClientByNameOrLastName');

});
