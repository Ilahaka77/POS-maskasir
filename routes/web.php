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
Route::get('/', function(){
    return view('auth.login');
});
Auth::routes();

Route::get('api/password/{token}', 'Api\Auth\ResetPasswordController@showResetForm')->name('api.password.reset');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth', 'role:admin', 'verified');
Route::get('/profil', 'HomeController@show')->name('profil')->middleware('auth');
Route::put('/profil/editPhoto/{id}', 'HomeController@editPhoto')->middleware('auth');

Route::get('/notifrole', function () {
    return view('notifrole');
});