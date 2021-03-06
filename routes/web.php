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

Route::resource ('funciones', 'FuncionController');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('/funciones/{id}/participar', 'ParticiparFuncionController@participar');

Route::delete('/funciones/{id}/participantes/{user_id}', 'ParticiparFuncionController@eliminar');

Route::get('/users', 'UserController@index');

Route::post('/users/{id}/cambio-rol', 'UserController@cambioRol');