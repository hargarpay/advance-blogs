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

Route::pattern('user', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('comment', '[0-9]+');

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'auth'], function(){
	Route::get('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
	Route::post('/login', 'Auth\LoginController@login');
	Route::post('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
	Route::post('/password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
	Route::get('/password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
	Route::get('/password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
	Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
	Route::get('/password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
});

Route::get('users/view', ['as' => 'view.users', 'uses' => 'Auth\RegisterController@view']);
Route::group(['prefix' => 'user'], function(){
	Route::get('/create', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
	Route::post('/create',  'Auth\RegisterController@register');
	Route::get('{user}/update', ['as' => 'update.user', 'uses' => 'Auth\RegisterController@edit']);
	Route::post('{user}/update',  'Auth\RegisterController@update');
	Route::delete('{user}/delete', ['as' => 'delete.user', 'uses' => 'Auth\RegisterController@delete']);
});

Route::get('/posts/view', ['as' => 'view.posts', 'uses' => 'PostController@view']);
Route::get('/posts/view-trash', ['as' => 'view.trash.posts', 'uses' => 'PostController@viewTrash']);
Route::group(['prefix' => 'post'], function(){
	Route::get('create', ['as' => 'create.post', 'uses' => 'PostController@create']);
	Route::post('create', 'PostController@store');
	Route::get('{post}/update', ['as' => 'update.post', 'uses' => 'PostController@edit']);
	Route::post('{post}/update', 'PostController@update');
	Route::put('{post}/restore', ['as' => 'restore.post', 'uses' => 'PostController@restore']);
	Route::put('{post}/publish', ['as' => 'publish.post', 'uses' => 'PostController@publish']);
	Route::put('{post}/draft', ['as' => 'draft.post', 'uses' => 'PostController@draft']);
	Route::delete('{post}/trash', ['as' => 'trash.post', 'uses' => 'PostController@trash']);
	Route::delete('{post}/delete', ['as' => 'delete.post', 'uses' => 'PostController@permanentDelete']);
});

Route::group(['prefix' => 'comments'], function(){
	Route::get('view', ['as' => 'get.comments', 'uses' => 'CommentController@getComments']);
	Route::get('{post}/create', ['as' => 'create.comment', 'uses' => 'CommentController@create']);
	// Route::get('{post}/update', ['as' => 'update.post', 'uses' => 'PostController@edit']);
	// Route::post('{post}/update', 'PostController@update');
	// Route::delete('{post}/delete', ['as' => 'delete.post', 'uses' => 'PostController@permanentDelete']);
});

Route::get('/home', 'HomeController@index')->name('home');
