<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function newTransaksi(Request $request)
    {
        $transaksi = Transaksi::create([
            'kode_transaksi',
            'kasir' => Auth::user()->id
        ]);
    }
}
