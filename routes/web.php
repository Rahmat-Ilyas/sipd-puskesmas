<?php

use Illuminate\Support\Facades\Route;

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

// User
Route::group(['prefix' => 'user'], function () {
    Route::get('/login', 'Auth\AuthUserController@showLoginForm')->name('user.login');
    Route::post('/login', 'Auth\AuthUserController@login')->name('user.login.submit');
    Route::get('/daftar', 'Auth\AuthUserController@daftar')->name('user.daftar');
    Route::post('/daftar', 'Auth\AuthUserController@storeDaftar')->name('user.daftar.store');
    Route::get('/logout', 'Auth\AuthUserController@logout')->name('user.logout');
    Route::get('/', 'UserController@home')->name('user.home');

    Route::get('/{page}', 'UserController@page');
    Route::get('/{dir}/{page}', 'UserController@pagedir');
});

// Admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'Auth\AuthAdminController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AuthAdminController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AuthAdminController@logout')->name('admin.logout');
    Route::get('/', 'AdminController@home')->name('admin.home');

    Route::post('/store/{target}', 'AdminController@store');
    Route::post('/update/{target}', 'AdminController@update');
    Route::get('/delete/{target}/{id}', 'AdminController@delete');

    Route::get('/{page}', 'AdminController@page');
    Route::get('/{dir}/{page}', 'AdminController@pagedir');
});

// Doctor
Route::group(['prefix' => 'doctor'], function () {
    Route::get('/login', 'Auth\AuthDoctorController@showLoginForm')->name('doctor.login');
    Route::post('/login', 'Auth\AuthDoctorController@login')->name('doctor.login.submit');
    Route::get('/logout', 'Auth\AuthDoctorController@logout')->name('doctor.logout');
    Route::get('/', 'DoctorController@home')->name('doctor.home');

    Route::get('/{page}', 'DoctorController@page');
    Route::get('/{dir}/{page}', 'DoctorController@pagedir');
});