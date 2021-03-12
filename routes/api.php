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
    Route::put('/profil/edit', 'Api\Auth\AuthController@editProfil');
    Route::get('/profil', 'Api\Auth\AuthController@profil');

    //CRUD Supplier
    Route::get('/supplier', 'Api\SupplierController@index');
    Route::post('/supplier', 'Api\SupplierController@create');
    Route::get('/supplier/{id}', 'Api\SupplierController@show');
    Route::put('/supplier/{id}', 'Api\SupplierController@update');

    //CRUD Kategori
    Route::get('/kategori', 'Api\CategoryController@index');
    Route::post('/kategori', 'Api\CategoryController@create');
    Route::get('/kategori/{id}', 'Api\CategoryController@show');
    Route::put('/kategori/{id}', 'Api\CategoryController@update');

    //CRUD Barang
    Route::get('/barang', 'Api\BarangController@index');
    Route::post('/barang', 'Api\BarangController@create');
    Route::get('/barang/{id}', 'Api\BarangController@show');
    Route::put('/barang/{id}', 'Api\BarangController@update');

    //CRUD Pengeluaran
    Route::get('/pengeluaran', 'Api\PengeluaranController@index');
    Route::post('/pengeluaran', 'Api\PengeluaranController@create');
    Route::get('/pengeluaran/{id}', 'Api\PengeluaranController@show');
    Route::put('/pengeluaran/{id}', 'Api\PengeluaranController@update');

    //CRUD Pembelian
    Route::get('/pembelian', 'Api\PembelianController@inex');
    Route::post('/pembelian/new', 'Api\PembelianController@newPembelian');
    Route::get('/pembelian/{id}', 'Api\PembelianController@show');
    Route::post('/pembelian/add/{id}', 'Api\PembelianController@addItem');
    Route::put('/pembelian/edit/{id}', 'Api\PembelianController@editItem');
    Route::delete('/pembelian/delete/{id}', 'Api\PembelianController@deleteItem');
    Route::get('/pembelian/save/{id}', 'Api\PembelianController@save');

    //CRUD Member
    Route::post('/member', 'Api\MemberController@create');
    Route::get('/member', 'Api\MemberController@index');
    Route::get('/member/{id}', 'Api\MemberController@show');
    Route::put('/member/{id}', 'Api\MemberController@update');
    Route::put('/member/{id}/topup', 'Api\MemberController@topup');

    //CRUD Penjualan
    Route::get('/penjualan', 'Api\TransaksiController@index');
    Route::get('/penjualan/new', 'Api\TransaksiController@newTransaksi');
    Route::post('/penjualan/add/{id}', 'Api\TransaksiController@add');
    Route::post('/penjualan/update/{id}', 'Api\TransaksiController@updateItem');
    Route::delete('/penjualan/delete/{id}', 'Api\TransaksiController@deleteItem');
    Route::post('/penjualan/harga/{id}', 'Api\TransaksiController@getHarga');
    Route::post('/penjualan/bayar/{id}', 'Api\TransaksiController@bayar');
    Route::delete('/penjualan/cencel/{id}', 'Api\TransaksiController@cencel');
    Route::get('/penjualan/{id}', 'Api\TransaksiController@show');
    
});


