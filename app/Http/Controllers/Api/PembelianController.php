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
        $pembelian = Pembelian::select('pembelians.id', 'suppliers.nama_suppliers', 'pembelians.diskon', 'pembelians.total_bayar', 'pembelians.created_at as tanggal')->join('suppliers', 'pembelians.supplier_id', '=', 'suppliers.id')->get();
        // dd($pembelian);
        return response()->json([
            'data' => $pembelian
        ],200);
    }

    public function show($id)
    {
        $pembelian = DB::table('pembelians')->select('pembelians.id','suppliers.nama_supplier', 'pembelians.total_bayar')
            ->where('pembelians.id', '=', $id)->first();
        $detail = DB::table('detail_pembelians')
            ->select('detail_pembelians.id','barangs.barcode','barangs.nama_barang', 'categories.kategori', 'barangs.merek', 'detail_pembelians.jumlah', 'detail_pembelians.harga')
            ->where('detail_pembelians.pembelian_id', '=', $id)
            ->leftJoin('barangs', 'detail_pembelians.barang_id', '=', 'barangs.id')
            ->leftJoin('categories', 'barangs.kategori_id', '=', 'categories.id')
            ->get();

        return response()->json([
            'pembelian' => $pembelian,
            'detail' => $detail
        ], 200);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'supplier' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'messages' => $validator->messages()->first()
            ], 400);
        }

        try {
            $pembelian = Pembelian::create([
                'supplier_id' => $request->supplier,
                'diskon' => 0,
                'total_bayar' => 0
            ]);

            return response()->json([
                'status' => 'success',
                'pembelian' => $pembelian
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'messages' => $th->getMessage()
            ], 201);
        }
    }

    public function addItem(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'barang' => 'required',
            'jumlah' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'messages' => $validator->messages()->first(),
            ], 400);
        }

        try {
            $pembelian = Pembelian::find($id);
            $barang = Barang::find($request->barang);
            $detail = DetailPembelian::create([
                'pembelian_id' => $id,
                'barang_id' => $request->barang,
                'jumlah' => $request->jumlah,
                'harga' => $barang->harga_jual * $request->jumlah,
            ]);
            $pembelian->total_bayar = $pembelian->total_bayar + $detail->harga;
            $pembelian->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menambah barang',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 400);
        }
    }

    public function editItem(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jumlah' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()->first()
            ], 400);
        }

        try {
            $detail = DetailPembelian::find($id);
            $barang = Barang::find($detail->barang_id);
            $pembelian = Pembelian::find($detail->pembelian_id);

            $pembelian->total_bayar = $pembelian->total_bayar - $detail->harga;
            $pembelian->save();

            $detail->jumlah = $request->jumlah;
            $detail->harga = $barang->harga_jual * $request->jumlah;
            $detail->save();

            $pembelian->total_bayar = $pembelian->total_bayar + $detail->harga;
            $pembelian->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mengubah list barang'
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
    
    public function deleteItem($id){
        $detail = DetailPembelian::find($id);
        $detail->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menghapus barang dari list'
        ], 200);
    }

    public function cencel($id)
    {
        $pembelian = Pembelian::where('id', $id)->first();
        $pembelian->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil membatalkan pembelian'
        ], 200);
    }

    
}
