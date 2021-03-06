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

// Frontend
Route::get('/', 'FrontendController@index');


// Backend routes
Route::group(['prefix' => 'backend', 'middleware' => ['role:admin']], function() {
	Route::get('/', 'BackendController@index');
	Route::get('/roles', 'BackendController@roles');
});

Route::get('/mylogin', 'BackendController@myLogin');
Route::get('/mylogout', 'BackendController@myLogout');


// Status
Route::post('/status', 'TotemController@updateStatus');

// Player
Route::group(['prefix' => 'player'], function() {
	Route::get('/', 'PlayerController@index');
});


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => 'auth'], function()
{
	Route::resource('totems', 'TotemController');
	Route::resource('clips', 'ClipController');
});


Auth::routes();

Route::get('/home', 'HomeController@index');