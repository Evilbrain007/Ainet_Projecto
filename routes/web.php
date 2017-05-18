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


Route::get('/departament/{id}', 'DepartmentController@detail')->name('departmentDetail');


Route::get('users/image/{user_id}', 'UserController@getUserImage')->name('getUserImage');

Route::get('/users/edit/{id}', 'UserController@edit')->middleware('auth')->name('editUser');

Route::post('/users/edit/{id}', 'UserController@update')->middleware('auth')->name('updateUser');

Route::get('/user/{id}', 'UserController@details')->name('userDetail');


Route::get('/requests/dashboard', 'RequestController@dashboard')->middleware('auth')->name('requestsDashboard');

Route::get('/requests/create', 'RequestController@create')->middleware('auth')->name('createRequest');

Route::post('/requests/create', 'RequestController@store')->middleware('auth');

Route::get('/requests/edit/{id}', 'RequestController@edit')->middleware('auth')->name('editRequest');

Route::post('/requests/edit/{id}', 'RequestController@update')->middleware('auth')->name('updateRequest');

Route::get('/requests/edit/image/{id}', 'RequestController@getImageRequest')->middleware('auth')->name('getImageRequest');

Route::get('/request/{id}', 'RequestController@details')->middleware('auth')->name('requestDetails');

Route::post('/request/remove', 'RequestController@remove')->middleware('auth')->name('removeRequest');


Route::post('requests/comments/create', 'CommentController@store')->middleware('auth')->name('createComment');

Route::post('requests/comments/create/response', 'CommentController@storeReply')->middleware('auth')->name('createResponse');


Route::get('/admin', 'DashboardController@getIndex')->middleware('auth')->middleware('admin')->name('homeAdmin');

Route::post('admin/user/{id}/setadmin', 'UserController@setUserAsAdmin')->middleware('auth')->middleware('admin')->name('setUserAsAdmin');

Route::post('admin/user/{id}/setemployee', 'UserController@setUserAsEmployee')->middleware('auth')->middleware('admin')->name('setUserAsEmployee');

Route::post('admin/user/{id}/block', 'UserController@blockUser')->middleware('auth')->middleware('admin')->name('blockUser');

Route::post('admin//user/{id}/unblock', 'UserController@unblockUser')->middleware('auth')->middleware('admin')->name('unblockUser');


Auth::routes();

Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');


