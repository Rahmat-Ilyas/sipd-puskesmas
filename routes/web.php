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
Route::get('/', 'UserController@home');
Route::group(['prefix' => 'user'], function () {
    Route::get('/login', 'Auth\AuthUserController@showLoginForm')->name('user.login');
    Route::post('/login', 'Auth\AuthUserController@login')->name('user.login.submit');
    Route::get('/daftar', 'Auth\AuthUserController@daftar')->name('user.daftar');
    Route::post('/daftar', 'Auth\AuthUserController@storeDaftar')->name('user.daftar.store');
    Route::get('/logout', 'Auth\AuthUserController@logout')->name('user.logout');
    Route::get('/', 'UserController@home')->name('user.home');

    Route::post('/config', 'UserController@config');
    Route::post('/store/{target}', 'UserController@store');
    Route::post('/update/{target}', 'UserController@update');
    Route::get('/delete/{target}/{id}', 'UserController@delete');

    Route::get('/{page}', 'UserController@page');
    Route::get('/{dir}/{page}', 'UserController@pagedir');
});

// Admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'Auth\AuthAdminController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AuthAdminController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AuthAdminController@logout')->name('admin.logout');
    Route::get('/', 'AdminController@home')->name('admin.home');

    Route::post('/config', 'AdminController@config');
    Route::post('/store/{target}', 'AdminController@store');
    Route::post('/update/{target}', 'AdminController@update');
    Route::get('/delete/{target}/{id}', 'AdminController@delete');

    Route::get('/{page}', 'AdminController@page');
    Route::get('/{dir}/{page}', 'AdminController@pagedir');
});

// Poli
Route::group(['prefix' => 'poli'], function () {
    Route::get('/login', 'Auth\AuthPoliController@showLoginForm')->name('poli.login');
    Route::post('/login', 'Auth\AuthPoliController@login')->name('poli.login.submit');
    Route::get('/logout', 'Auth\AuthPoliController@logout')->name('poli.logout');
    Route::get('/', 'PoliController@home')->name('poli.home');

    Route::get('/{page}', 'PoliController@page');
    Route::get('/{dir}/{page}', 'PoliController@pagedir');
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
