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
/*
Route::get('/', function () {
    return view('dashboard');
});
*/
Route::get('/', 'DashboardController@getIndex');

Route::get('/requests', function () {
    return 'Lista de Pedidos de Impressão';
});
Route::get('/request/{id}', function () {
    return 'Detalhe de um Pedido';
});

Route::get('/requests/create', 'RequestController@create');

Route::post('/requests/create', 'RequestController@store');

Route::get('/requests/details', 'RequestController@details');

Route::get('/requests/dashboard', 'RequestController@dashboard');

Route::get('/requests/edit/{id}', function () {
    return 'Página para editar informação de um pedido';
});
Route::post('/requests/update/{id}', function () {
    return 'Editar informação de um pedido';
});
Route::post('/requests/delete/{id}', function () {
    return 'Eliminar informação de um pedido';
});



Route::get('/departament/{id}', function () {
    return 'Lista de utilizadores';
});
Route::get('/user/{id}', function () {
    return 'Detalhe de um utilizador';
});

Route::get('/login', function () {
    return 'Página de Login';
});
Route::get('/logout', function () {
    return 'Página de Logout';
});
Route::get('/signin', function () {
    return 'Página de registo';
});


Auth::routes();

Route::get('/home', 'HomeController@index');
