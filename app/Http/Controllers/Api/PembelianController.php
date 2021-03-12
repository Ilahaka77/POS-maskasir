<?php

namespace App\Http\Controllers\Api;

use App\Barang;
use App\DetailPembelian;
use App\Http\Controllers\Controller;
use App\Http\Resources\PembelianResource;
use App\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{
    
    public function index()
    {
        $pembelian = Pembelian::with('supplier')->get();
        // dd($pembelian);
        return response()->json([
            'data' => PembelianResource::collection($pembelian)
        ],200);
    }

    public function show($id)
    {
        $pembelian = DB::table('pembelians')->select('pembelians.id','suppliers.nama_supplier', 'pembelians.total_bayar')
            ->where('pembelians.id', '=', $id)->first();
        $detail = DB::table('detail_pembelians')
            ->select('barangs.barcode','barangs.nama_barang', 'categories.kategori', 'barangs.merek', 'detail_pembelians.jumlah', 'detail_pembelians.harga')
            ->where('detail_pembelians.pembelian_id', '=', $id)
            ->leftJoin('barangs', 'detail_pembelians.barang_id', '=', 'barangs.id')
            ->leftJoin('categories', 'barangs.kategori_id', '=', 'categories.id')
            ->get();

        return response()->json([
            'pembelian' => $pembelian,
            'detail' => $detail
        ], 200);
    }

    public function newPembelian(Request $request)
    {
        $validator = Validator::make($request->all(),[

        ]);

        $pembelian = Pembelian::create([

        ]);
    }


}
