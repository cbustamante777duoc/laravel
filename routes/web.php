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

Route::get('/', 'MainController@index')->name('main');

//ruta que retorna un lista
Route::get('products','ProductController@index')->name('products.index');

//retorna todas las rutas del Controller de Producto
Route::resource('products', 'ProductController');

//retorna  la rutas de index Controller de Cart
Route::resource('carts', 'CartController')->only(['index']);

Route::resource('orders', 'OrderController')->only(['create', 'store']);

//va a retornar solo las ruta de store y destroy del controller de ProductCart
Route::resource('products.carts', 'ProductCartController')->only(['store','destroy']);

Route::resource('orders.payments', 'OrderPaymentController')->only(['create','store']);



/*

//ruta que retorna un un formulario
Route::get('products/create','ProductController@create' )->name('products.create');

//ruta que crea un producto
Route::post('products','ProductController@store' )->name('products.store');


// //ruta que recibe un parametro muestra el titulo y lo muestra
// Route::get('products/{product:title}', 'ProductController@show')->name('products.show');

Route::get('products/{product}', 'ProductController@show')->name('products.show');


//ruta que recibe  el id y edita el producto a traves del formulario
Route::get('products/{product}/edit','ProductController@edit')->name('products.edit');


//ruta que recibe dos metodos de envios put o patch para poder editar
Route::match(['put','patch'], 'products/{product}','ProductController@update')->name('products.update');


//ruta que recibe un parametro y elimina un producto
Route::delete('products/{product}','ProductController@destroy')->name('products.destroy');

//retornador welcome desde el main controller
Route::get('main','MainController@index')->name('main.index');

//Route::get('main/list','MainController@list')->name('main.list');

*/

// php artisan route:list



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
