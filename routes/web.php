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
 * All urls should be hyphenated
 */

Route::get('/', function () {
    return view('welcome');
})->name('index');

// Auth Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::get('register/{token}', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('home', 'HomeController@index')->name('home');
Route::get('access-codes', 'HomeController@accessCodes')->name('accessCodes');

// Routes in the following group can only be access from inside the hackspace (as defined by the ip range in .env)
Route::group(['middleware' => 'ipcheck'], function () {
    Route::get('/register-interest', 'RegisterInterestController@index')->name('registerInterest');
    Route::post('/register-interest', 'RegisterInterestController@registerInterest');
});

// Routes in the following group can only be access once logged-in)
Route::group(['middleware' => 'auth'], function () {
    // ROLE
    Route::get('/roles', 'RoleController@index')->name('roles.index');
    Route::get('/roles/{role}', 'RoleController@show')->name('roles.show');
    Route::get('/roles/{role}/edit', 'RoleController@edit')->name('roles.edit');
    Route::put('/roles/{role}', 'RoleController@update')->name('roles.update');
    Route::delete('/roles/{role}/users/{user}', 'RoleController@removeUser')->name('roles.removeUser');

    // USER
    Route::get('/users/{user}', 'UserController@show')->name('users.show');

    // Admin
    Route::get('admin', 'HomeController@admin')->name('admin');

    // Meta area covers various setting for HMS
    Route::resource('metas', 'MetaController',
        [
            'except' => ['show', 'store', 'create', 'destroy'],
        ]
    );

    // Usefull links
    Route::resource('links', 'LinksController',
        [
            'except' => ['show'],
        ]
    );
});
