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

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'supplier_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()->first()
            ],400);
        }
        
        try {
            $pembelian = Pembelian::create([
                'supplier_id' => $request->supplier_id,
                'total_bayar' => 0
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Create pembelian successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 201);
        }
    }

    public function addItem(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'barang' => 'required',
            'jumlah' => 'required'
        ]);
        $item = $request->pembelian;
        try {
            $barang = Barang::find($request->barang);
            $detail= DetailPembelian::create([
                'pembelian_id' => $id,
                'barang_id' => $request->barang,
                'jumlah' => $request->jumlah,
                'harga' => $request->jumlah*$barang->harga_jual
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }

        $pembelian = Pembelian::find($id);
        try {
            $pembelian->total_bayar = $pembelian->total_bayar + $detail->harga;
            $pembelian->save();
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 400);
        }

        return response()->json([
             'status' => 'success',
             'message' => 'successfully adding an item'
        ],200);

    }

    public function cencel($id)
    {
        $pembelian = Pembelian::where('id', $id)->first();

        $pembelian->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Pembelian is cenceled'
        ], 200);
    }
}
