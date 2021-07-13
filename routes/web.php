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
})->name('main');


//ruta que retorna un lista
Route::get('products','ProductController@index')->name('products.index');


//ruta que retorna un un formulario
Route::get('products/create','ProductController@create' )->name('products.create');

//ruta que crea un producto
Route::post('products','ProductController@store' )->name('products.store');


//ruta que recibe un parametro muestra el id y lo muestra
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

// php artisan route:list


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
