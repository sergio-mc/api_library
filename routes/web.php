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
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Auth::routes();

Route::get('/filtro', function (){
    return view('filter');
});





// Ruta para la vista del filtrado de libros pública
Route::get('/filtradoLibro', 'LibrosController@getLibrosParam');

// Ruta para la vista de prestamosDevoluciones sacadas por el id del usuario logeado
Route::get('/prestamosDevoluciones/{id}', 'ServiciosController@getAll');


