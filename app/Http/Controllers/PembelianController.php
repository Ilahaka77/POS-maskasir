<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Pembelian;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelian = Pembelian::select('pembelians.*', DB::raw('sum(detail_pembelians.jumlah) as total_item'),  DB::raw('sum(detail_pembelians.harga) as total_harga'), 'suppliers.id as suppliers_id', 'suppliers.nama_supplier')->join('detail_pembelians', 'pembelians.id', '=', 'detail_pembelians.pembelian_id')->join('suppliers', 'suppliers.id', '=', 'pembelians.supplier_id')->groupBy('pembelians.id')->get();

        $supplier = Supplier::get();

        // dd($pembelian);
        return view('pembelian.index', ['menu'=>'pembelian', 'pembelian'=>$pembelian, 'supplier'=>$supplier]);
    }

    public function newPembelian($id)
    {
        // $pembelian = Pembelian::create([
        //     'supplier_id' => $id,
        //     'diskon' => 0,
        //     'total_bayar' => 0
        // ]);
        // $detail = Pembelian::where('id', $pembelian->id)->with('supplier')->first();
        $supplier = Supplier::get();
        $barang = Barang::get();

        // return view('pembelian.create', ['menu' => 'pembelian', 'pembelian' => $detail, 'supplier' => $supplier, 'barang'=>$barang]);
        return view('pembelian.create', ['menu' => 'pembelian','supplier' => $supplier, 'barang'=>$barang]);
    }

    public function cencel($id)
    {
        $pembelian = Pembelian::where('id', $id)->first();
        $pembelian->delete();

        return redirect('/pembelian');
    }

    public function getitem($id){
        try {
            $barang = Barang::where('barcode', '=', $id)->first();
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        echo $barang;
    }
}
