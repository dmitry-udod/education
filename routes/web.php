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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:' . \App\Role::ROLE_SLUG_ADMIN]], function() {
    Route::get('/', 'HomeController@index');
    Route::resource('roles', 'Admin\RoleController');
    Route::resource('users', 'Admin\UserController');
    Route::resource('categories', 'Admin\CategoryController');
});
