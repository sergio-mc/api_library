<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* CRUD[LIBROS] */
Route::get('/libros', 'LibrosController@getLibros');
Route::middleware('auth:api')->post('/libros', 'LibrosController@postLibros');
Route::middleware('auth:api')->put('/libros', 'LibrosController@putLibros');
Route::middleware('auth:api')->delete('/libros', 'LibrosController@deleteLibros');


/* CRUD[USUARIOS] */
Route::middleware('auth:api')->get('/usuarios', 'UsuariosController@getUsuarios');
Route::post('/usuarios', 'UsuariosController@postUsuarios');
Route::middleware('auth:api')->put('/usuarios', 'UsuariosController@putUsuarios');
Route::middleware('auth:api')->delete('/usuarios', 'UsuariosController@deleteUsuarios');

/* CONSULTA PÚBLICA PARA OBTENER LISTADO DE LIBROS */ // DONE++ FALTA REVISAR Y PONER COMPROBACIONES
Route::get('/librosFiltro','LibrosController@getLibrosParam');

/* RUTAS DE PRESTAMOS Y DEVOLUCIONES */

Route::post('/prestamo','ServiciosController@prestar');
Route::put('/devolucion','ServiciosController@devolver');


