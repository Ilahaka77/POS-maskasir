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
        $pembelian = DB::table('pembelians')->select('pembelians.id', 'suppliers.nama_supplier')
            ->where('pembelians.id', $id)
            ->leftJoin('suppliers', 'pembelians.supplier_id', '=', 'suppliers.id')
            ->first();
        
        $detail = DB::table('detail_pembelians')
            ->select('detail_pembelians.id', 'barangs.barcode', 'barangs.nama_barang', 'categories.kategori', 'barangs.merek', 'barangs.harga_beli', 'detail_pembelians.jumlah', 'detail_pembelians.harga')
            ->where('detail_pembelians.pembelian_id', $id)
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
            'supplier' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()->first()
            ], 400);
        }

        $pembelian = Pembelian::create([
            'supplier_id' => $request->supplier,
            'total_bayar' => 0
        ]);

        return response()->json([
            'pembelian' => $pembelian
        ],200);
    }

    public function addItem(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'barang' => 'required',
            'jumlah' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()->first()
            ], 400);
        }

        $barang = Barang::where('id', $request->barang)->first();
        $detail = DetailPembelian::create([
            'pembelian_id' => $id,
            'barang_id' => $request->barang,
            'jumlah' => $request->jumlah,
            'harga' => $request->jumlah * $barang->harga_beli,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Add item successfully'
        ]);
    }

    public function editItem(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'jumlah' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'messages' => $validator->messages()->first()
            ], 400);
        }

        $detail = DetailPembelian::where('id', $id)->first();
        $barang = Barang::where('id', $detail->barang_id)->first();

        $detail->harga = $request->jumlah * $barang->harga_beli;
        $detail->jumlah = $request->jumlah;
        $detail->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Edit Item successfully'
        ], 200);
    }

    public function deleteItem($id)
    {
        $detail = DetailPembelian::where('id', $id)->first();
        $detail->delete();

        return response()->json([
            'status' => 'success',
            'messages' => 'Delete Item successfully'
        ], 200);
    }

    public function save($id)
    {
        $total_harga = DB::table('detail_pembelians')->select(DB::raw('SUM(harga) as total_bayar'))->where('pembelian_id', $id)->first();

        $pembelian = Pembelian::where('id', $id)->first();
        $pembelian->total_bayar = $total_harga->total_harga;
        $pembelian->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Save is successfully'
        ], 200);
    }


}
