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
Route::get('/', 'DashboardController@getIndex')->middleware('user_not_blocked')->name('home');

Route::get('/departament/{id}', 'DepartmentController@detail')->middleware('user_not_blocked')->name('department.detail');

Route::get('users/image/{user_id}', 'UserController@getUserImage')->middleware('user_not_blocked')->name('user.image');

Route::get('/users/edit/{id}', 'UserController@edit')->middleware('auth', 'user_not_blocked')->name('user.edit');

Route::post('/users/edit/{id}', 'UserController@update')->middleware('auth', 'user_not_blocked')->name('user.update');

Route::get('/user/{id}', 'UserController@details')->middleware('user_not_blocked')->name('user.detail');


Route::get('/requests/dashboard', 'RequestController@dashboard')->middleware('auth', 'user_not_blocked')->name('requests.dashboard');

Route::get('/requests/create', 'RequestController@create')->middleware('auth', 'user_not_blocked')->name('request.create');

Route::post('/requests/create', 'RequestController@store')->middleware('auth', 'user_not_blocked');

Route::get('/requests/edit/{id}', 'RequestController@edit')->middleware('auth', 'user_not_blocked')->name('request.edit');

Route::post('/requests/edit/{id}', 'RequestController@update')->middleware('auth', 'user_not_blocked')->name('request.update');

Route::get('/request/{id}', 'RequestController@details')->middleware('auth', 'user_not_blocked')->name('request.details');

Route::get('/request/{id}/file', 'RequestController@getFile')->name('request.file');

Route::post('/request/{id}/assess', 'RequestController@assessRequest')->middleware('auth', 'user_not_blocked')->name('request.assess');

Route::post('/request/remove', 'RequestController@remove')->middleware('auth', 'user_not_blocked')->name('request.remove');


Route::post('requests/comments/create', 'CommentController@store')->middleware('auth', 'user_not_blocked')->name('comment.create');

Route::post('requests/comments/create/response', 'CommentController@storeReply')->middleware('auth', 'user_not_blocked')->name('comment.response.create');

Route::post('admin/requests/comment/{id}/block', 'CommentController@block')->middleware('auth', 'user_not_blocked', 'admin')->name('comment.block');


Route::post('admin/user/{id}/setadmin', 'UserController@setUserAsAdmin')->middleware('auth', 'admin', 'user_not_blocked')->name('user.admin');

Route::post('admin/user/{id}/setemployee', 'UserController@setUserAsEmployee')->middleware('auth', 'admin', 'user_not_blocked')->name('user.employee');

Route::post('admin/user/{id}/block', 'UserController@blockUser')->middleware('auth', 'admin', 'user_not_blocked')->name('user.block');

Route::post('admin/user/{id}/unblock', 'UserController@unblockUser')->middleware('auth', 'admin', 'user_not_blocked')->name('user.unblock');

Route::post('admin/request/{id}/close', 'RequestController@closeRequest')->middleware('auth', 'admin', 'user_not_blocked')->name('request.close');

Route::post('admin/request/{id}/refuse', 'RequestController@refuseRequest')->middleware('auth', 'admin', 'user_not_blocked')->name('request.refuse');

Auth::routes();


Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');


