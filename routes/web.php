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

Auth::routes();

Route::get('/', 'MainController@index')->name('index');

// Route::get('/admin', 'AdminController@index')->middleware('auth', 'role:admin')->name('admin');

// Route::post('/slider', 'AdminController@storeSlider')->middleware('auth', 'role:admin')->name('slider.admin');

// Route::get('/categorias/{slug}', 'ProductController@categoryShow')->name('category.show');

// Route::get('/{category}/prod/{slug}', 'ProductController@productShow')->name('product.show');

Route::get('/carrito', 'CartController@index')->name('cart');

Route::get('/notifications', 'CartController@index');

Route::get('/agregar/{id}', 'CartController@addProduct');

Route::get('/pay', 'CartController@pay');

Route::get('/order/{customid}/create', 'CartController@createOrder');

Route::get('/success', 'CartController@success');

Route::get('/thanks/{customid}', 'CartController@thanks')->name('thanks');

Route::get('/logout', function () {

	Auth::logout();

	return redirect()->back();
})->name('auth_logout'); 