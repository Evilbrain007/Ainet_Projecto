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
Route::get('/', 'DashboardController@getIndex')->name('home');


Route::get('/requests', function () {
    return 'Lista de Pedidos de Impressão';
});
Route::get('/request/{id}', function () {
    return 'Detalhe de um Pedido';
});

// faltam rotas para criacao de pedidos
Route::get('/requests/create', 'RequestController@create');

Route::post('/requests/create', 'RequestController@store');

Route::get('/requests/details', 'RequestController@details');

Route::get('/requests/dashboard', 'RequestController@dashboard')->name('requestsDashboard');

Route::get('/requests/edit/{id}', function () {
    return 'Página para editar informação de um pedido';
});
Route::post('/requests/update/{id}', function () {
    return 'Editar informação de um pedido';
});
Route::post('/requests/delete/{id}', function () {
    return 'Eliminar informação de um pedido';
});




Route::get('/departament/{id}', 'DepartmentController@detail')->name('departmentDetail');

Route::get('/user/{id}', function () {
    return 'Detalhe de um utilizador';
});

Route::get('/login', function () {
    return 'Página de Login';
});

Route::get('/signin', function () {
    return 'Página de registo';
});


Auth::routes();

Route::get('/home', 'HomeController@index');
