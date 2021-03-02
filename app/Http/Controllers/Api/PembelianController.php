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
        $pembelian = DB::table('pembelians')->select('pembelians.*', 'suppliers.nama_supplier')->where('pembelians.id', $id)
            ->join('suppliers', 'suppliers.id', '=', 'pembelians.supplier_id')->first();
        $detail = DB::table('pembelians')
            ->select('barangs.barcode', 'barangs.nama_barang', 'categories.kategori', 'barangs.merek', 'detail_pembelians.jumlah', 'detail_pembelians.harga')
            ->where('pembelians.id', $id)
            ->leftJoin('detail_pembelians', 'pembelian_id', '=', 'pembelians.id')
            ->leftJoin('barangs', 'detail_pembelians.barang_id', '=', 'barangs.id')
            ->leftJoin('categories', 'barangs.kategori_id', '=', 'categories.id')
            ->leftJoin('suppliers', 'pembelians.supplier_id', '=', 'suppliers.id')->get();

        return response()->json([
            'pembelian' => $pembelian,
            'detail' => $detail
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'supplier' => 'required',
            'total_bayar' => 'required',
            'detail.*.barang' => 'required',
            'detail.*.jumlah' => 'required',
            'detail.*.harga' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()->first()
            ]);
        }

        $detail = $request->detail;
        try {

            $pembelian = Pembelian::create([
                'supplier_id' => $request->supplier,
                'total_bayar' => $request->total_bayar
            ]);

            foreach ($detail as $key => $value) {
                
                $barang = Barang::find($value['barang']);
                
                DetailPembelian::create([
                    'pembelian_id' => $pembelian->id,
                    'barang_id' => $value['barang'],
                    'jumlah' => $value['jumlah'],
                    'harga' => $value['harga']
                ]);
                $barang->stok = $barang->stok + $value['jumlah'];
                $barang->save();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Add Pembelian successfully'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error', 
                'message' => $th->getMessage()
            ], 201);
        }
    }
}
