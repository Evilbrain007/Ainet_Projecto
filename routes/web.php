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
Route::get('/', 'DashboardController@getIndex')->middleware('user_not_blocked')->middleware('user_not_blocked')->name('home');

Route::get('/departament/{id}', 'DepartmentController@detail')->middleware('user_not_blocked')->middleware('user_not_blocked')->name('department.detail');

Route::get('users/image/{user_id}', 'UserController@getUserImage')->middleware('user_not_blocked')->name('user.image');

Route::get('/users/edit/{id}', 'UserController@edit')->middleware('auth', 'user_not_blocked')->name('user.edit');

Route::post('/users/edit/{id}', 'UserController@update')->middleware('auth', 'user_not_blocked')->name('user.update');

Route::get('/user/{id}', 'UserController@details')->middleware('user_not_blocked')->name('user.detail');


Route::get('/requests/dashboard', 'RequestController@dashboard')->middleware('auth', 'user_not_blocked')->name('requests.dashboard');

Route::get('/requests/create', 'RequestController@create')->middleware('auth', 'user_not_blocked')->name('request.create');

Route::post('/requests/create', 'RequestController@store')->middleware('auth');

Route::get('/requests/edit/{id}', 'RequestController@edit')->middleware('auth', 'user_not_blocked')->name('request.edit');

Route::post('/requests/edit/{id}', 'RequestController@update')->middleware('auth', 'user_not_blocked')->name('request.update');

Route::get('/requests/edit/image/{id}', 'RequestController@getFile')->middleware('auth', 'user_not_blocked')->name('request.image');


Route::get('/request/{id}', 'RequestController@details')->middleware('auth', 'user_not_blocked')->name('request.details');

Route::get('/requests/{id}/file', 'RequestController@getFile')->middleware('auth', 'user_not_blocked')->name('request.file');

Route::get('/requests/{id}/assess', 'RequestController@assessRequest')->middleware('auth', 'user_not_blocked')->name('request.assess');


Route::post('/request/remove', 'RequestController@remove')->middleware('auth', 'user_not_blocked')->name('request.remove');


Route::post('requests/comments/create', 'CommentController@store')->middleware('auth', 'user_not_blocked')->name('comment.create');

Route::post('requests/comments/create/response', 'CommentController@storeReply')->middleware('auth', 'user_not_blocked')->name('comment.response.create');


Route::get('/admin', 'DashboardController@getIndex')->middleware('auth')->middleware('admin')->middleware('user_not_blocked')->name('home.admin');

Route::post('user/{id}/setadmin', 'UserController@setUserAsAdmin')->middleware('auth')->middleware('admin')->middleware('user_not_blocked')->name('user.admin');

Route::post('user/{id}/setemployee', 'UserController@setUserAsEmployee')->middleware('auth')->middleware('admin')->middleware('user_not_blocked')->name('user.employee');

Route::post('user/{id}/block', 'UserController@blockUser')->middleware('auth')->middleware('admin')->middleware('user_not_blocked')->name('user.block');

Route::post('user/{id}/unblock', 'UserController@unblockUser')->middleware('auth')->middleware('admin')->middleware('user_not_blocked')->name('user.unblock');

Route::post('request/{id}/close', 'RequestController@closeRequest')->middleware('auth')->middleware('admin')->middleware('user_not_blocked')->name('request.close');

Route::post('request/{id}/refuse', 'RequestController@refuseRequest')->middleware('auth')->middleware('admin')->middleware('user_not_blocked')->name('request.refuse');

Auth::routes();

Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');


