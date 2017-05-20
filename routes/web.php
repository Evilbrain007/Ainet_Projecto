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


Route::get('/departament/{id}', 'DepartmentController@detail')->name('department.detail');


Route::get('users/image/{user_id}', 'UserController@getUserImage')->name('user.image');

Route::get('/users/edit/{id}', 'UserController@edit')->middleware('auth')->name('user.edit');

Route::post('/users/edit/{id}', 'UserController@update')->middleware('auth')->name('user.update');

Route::get('/user/{id}', 'UserController@details')->name('user.detail');


Route::get('/requests/dashboard', 'RequestController@dashboard')->middleware('auth')->name('requests.dashboard');

Route::get('/requests/create', 'RequestController@create')->middleware('auth')->name('request.create');

Route::post('/requests/create', 'RequestController@store')->middleware('auth');

Route::get('/requests/edit/{id}', 'RequestController@edit')->middleware('auth')->name('request.edit');

Route::post('/requests/edit/{id}', 'RequestController@update')->middleware('auth')->name('request.update');

Route::get('/requests/edit/image/{id}', 'RequestController@getFile')->middleware('auth')->name('request.image');


Route::get('/request/{id}', 'RequestController@details')->middleware('auth')->name('request.details');

Route::get('/requests/{id}/file', 'RequestController@getFile')->middleware('auth')->name('request.file');

Route::get('/requests/{id}/assess', 'RequestController@assessRequest')->middleware('auth')->name('request.assess');


Route::post('/request/remove', 'RequestController@remove')->middleware('auth')->name('request.remove');


Route::post('requests/comments/create', 'CommentController@store')->middleware('auth')->name('comment.create');

Route::post('requests/comments/create/response', 'CommentController@storeReply')->middleware('auth')->name('comment.response.create');


Route::get('/admin', 'DashboardController@getIndex')->middleware('auth')->middleware('admin')->name('home.admin');

Route::post('user/{id}/setadmin', 'UserController@setUserAsAdmin')->middleware('auth')->middleware('admin')->name('user.admin');

Route::post('user/{id}/setemployee', 'UserController@setUserAsEmployee')->middleware('auth')->middleware('admin')->name('user.employee');

Route::post('user/{id}/block', 'UserController@blockUser')->middleware('auth')->middleware('admin')->name('user.block');

Route::post('user/{id}/unblock', 'UserController@unblockUser')->middleware('auth')->middleware('admin')->name('user.unblock');

Route::post('request/{id}/close', 'RequestController@closeRequest')->middleware('auth')->middleware('admin')->name('request.close');

Route::post('request/{id}/refuse', 'RequestController@refuseRequest')->middleware('auth')->middleware('admin')->name('request.refuse');

Auth::routes();

Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');


