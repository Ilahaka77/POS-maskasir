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
Auth::routes(['verify' => true]);

Route::get('api/password/{token}', 'Api\Auth\ResetPasswordController@showResetForm')->name('api.password.reset');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth','verified');
Route::get('/profil', 'HomeController@show')->name('profil')->middleware('auth', 'verified');
Route::get('/profil/getdata/{id}', 'HomeController@getdata')->middleware('auth', 'verified');
Route::put('/profil/editPhoto/{id}', 'HomeController@editPhoto')->middleware('auth', 'verified');
Route::put('/profil/changePassword', 'HomeController@changePassword')->middleware('auth', 'verified');
Route::put('/profil/edit', 'HomeController@editProfil')->middleware('auth', 'verified');

// Route Menu CRUD Staff
Route::get('/staff', 'StaffController@index')->name('staff')->middleware('auth', 'verified');
Route::post('/staff', 'StaffController@store')->name('staff.create')->middleware('auth', 'verified');
Route::get('/staff/getdata/{id}', 'StaffController@getData')->middleware('auth', 'verified');
Route::put('/staff/{id}/edit', 'StaffController@update')->middleware('auth', 'verified');

// Route Menu Crud Member
Route::get('/member', 'MemberController@index')->name('member')->middleware('auth', 'verified');
Route::post('/member', 'MemberController@create')->name('member.create')->middleware('auth', 'verified');
Route::get('/member/getdata/{id}', 'MemberController@show')->middleware('auth', 'verified');
Route::put('/member/{id}/edit', 'MemberController@update')->middleware('auth', 'verified');

//Route Menu CRUD Supplier
Route::get('/supplier', 'SupplierController@index')->middleware('auth', 'verified');
Route::post('/supplier', 'SupplierController@create')->middleware('auth', 'verified');
Route::get('/supplier/getdata/{id}', 'SupplierController@getData')->middleware('auth', 'verified');
Route::put('/supplier/{id}/edit', 'SupplierController@update')->middleware('auth', 'verified');

Route::get('/notifrole', function () {
    return view('notifrole');
});