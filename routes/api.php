<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'Api\Auth\AuthController@register');
Route::post('/login', 'Api\Auth\AuthController@login');
Route::post('/password/email', 'Api\Auth\ForgotPasswordController@sendResetLinkEmail')->name('api.password.email');
Route::post('/password/reset/{token}', 'Api\Auth\ResetPasswordController@showResetForm')->name('api.password.reset');
Route::post('/password/reset', 'Api\Auth\ResetPasswordController@reset')->name('api.password.update');
Route::get('/email/resend', 'Api\Auth\VerificationController@resend')->name('api.verification.resend');
Route::get('/email/verify/{id}/{hash}', 'Api\Auth\VerificationController@verify')->name('api.verification.verify');

Route::group(['middleware' => 'auth:api'], function(){
    Route::put('/password/change', 'Api\Auth\AuthController@resetPassword');
    Route::put('/profil/edit', 'Api\Auth\AuthController@editProil');
    Route::get('/profil', 'Api\Auth\AuthController@profil');

    //CRUD Supplier
    Route::get('/supplier', 'Api\SupplierController@index');
    Route::post('/supplier', 'Api\SupplierController@create');
    Route::get('/supplier/{id}', 'Api\SupplierController@show');
    Route::put('/supplier/{id}', 'Api\SupplierController@update');

    //CRUD Barang
    Route::get('/kategori', 'Api\CategoryController@index');
    Route::post('/kategori', 'Api\CategoryController@create');
    Route::get('/kategori/{id}', 'Api\CategoryController@show');
    Route::put('/kategori/{id}', 'Api\CategoryController@update');
});


