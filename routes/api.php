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
Route::post('/password/email', 'Api\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/email/resend', 'Api\Auth\VerificationController@resend')->name('api.verification.resend');
Route::get('/email/verify/{id}/{hash}', 'Api\Auth\VerificationController@verify')->name('api.verification.verify');

Route::group(['middleware' => 'auth:api'], function(){
    Route::put('/password/change', 'Api\Auth\AuthController@resetPassword');
    Route::put('/profil/edit', 'Api\Auth\AuthController@editProil');
    Route::get('/profil', 'Api\Auth\AuthController@profil');

    Route::get('/supplier', 'Api\SupplierController@index')->middleware('role:admin,staff');
    Route::post('/supplier', 'Api\SupplierController@create')->middleware('role:admin,staff');
});


