<?php

namespace App\Http\Controllers;

use App\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelian = Pembelian::select('pembelians.*', DB::raw('sum(detail_pembelians.jumlah) as total_item'),  DB::raw('sum(detail_pembelians.harga) as total_harga'), 'suppliers.id as suppliers_id', 'suppliers.nama_supplier')->join('detail_pembelians', 'pembelians.id', '=', 'detail_pembelians.pembelian_id')->join('suppliers', 'suppliers.id', '=', 'pembelians.supplier_id')->groupBy('pembelians.id')->get();

        // dd($pembelian);
        return view('pembelian.index', ['menu'=>'pembelian', 'pembelian'=>$pembelian]);
    }

    public function newPembelian(Request $request)
    {

    }

    public function cencel($id)
    {

    }
}
