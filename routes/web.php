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

Route::get('/requests/edit/{id}', 'RequestController@edit')->name('editRequest');

Route::get('/requests/create', 'RequestController@create')->name('createRequest');

Route::post('/requests/create', 'RequestController@store');

Route::get('/request/{id}', 'RequestController@details')->name('requestDetails');

Route::post('requests/comments/create', 'RequestsController@createComment')->name('createComment');

Route::get('/requests/dashboard', 'RequestController@dashboard')->name('requestsDashboard');

Route::post('/requests/update/{id}', function () {
    return 'Editar informação de um pedido';
});
Route::post('/requests/delete/{id}', function () {
    return 'Eliminar informação de um pedido';
});


Route::get('/departament/{id}', 'DepartmentController@detail')->name('departmentDetail');


Route::get('/user/{id}', 'UserController@details')->name('userDetail');

Route::post('/user/{id}/setadmin', 'UserController@setUserAsAdmin')->name('setUserAsAdmin');

Route::post('/user/{id}/setemployee', 'UserController@setUserAsEmployee')->name('setUserAsEmployee');

Route::post('/user/{id}/block', 'UserController@blockUser')->name('blockUser');

Route::post('/user/{id}/unblock', 'UserController@unblockUser')->name('unblockUser');



Auth::routes();

Route::get('/home', 'HomeController@index');
