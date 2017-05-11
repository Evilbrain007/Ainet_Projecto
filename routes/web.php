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

Route::get('/requests/edit/{id}', 'RequestController@edit')->middleware('auth')->name('editRequest');

Route::get('/requests/create', 'RequestController@create')->middleware('auth')->name('createRequest');

Route::post('/requests/create', 'RequestController@store')->middleware('auth');

Route::get('/request/{id}', 'RequestController@details')->middleware('auth')->name('requestDetails');

Route::post('requests/comments/create', 'RequestsController@createComment')->middleware('auth')->name('createComment');

Route::get('/requests/dashboard', 'RequestController@dashboard')->middleware('auth')->name('requestsDashboard');

Route::post('/requests/update/{id}', function () {
    return 'Editar informação de um pedido';
})->middleware('auth');
Route::post('/requests/delete/{id}', function () {
    return 'Eliminar informação de um pedido';
})->middleware('auth');


Route::get('/departament/{id}', 'DepartmentController@detail')->name('departmentDetail');


Route::get('/user/{id}', 'UserController@details')->middleware('auth')->name('userDetail');

Route::get('user/image/{user_id}', 'UserController@getUserImage')->name('getUserImage');

Route::get('/user/{id}', 'UserController@details')->name('userDetail');

Route::get('/user/edit/{id}', 'UserController@edit')->name('editUser');
Route::get('/admin', 'DashboardController@getIndex')->middleware('auth')->middleware('admin')->name('homeAdmin');

Route::post('/user/edit/{id}', 'UserController@update')->name('updateUser');
Route::post('admin/user/{id}/setadmin', 'UserController@setUserAsAdmin')->middleware('auth')->middleware('admin')->name('setUserAsAdmin');

Route::post('admin/user/{id}/setemployee', 'UserController@setUserAsEmployee')->middleware('auth')->middleware('admin')->name('setUserAsEmployee');

Route::post('admin/user/{id}/block', 'UserController@blockUser')->middleware('auth')->middleware('admin')->name('blockUser');

Route::post('admin//user/{id}/unblock', 'UserController@unblockUser')->middleware('auth')->middleware('admin')->name('unblockUser');



Auth::routes();

Route::get('/home', 'HomeController@index');
