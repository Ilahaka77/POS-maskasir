<?php

namespace App\Http\Controllers\Api;

use App\Barang;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();

        return response()->json([
            'data' => BarangResource::collection($barang)
        ], 200);
    }

    public function cariBarcode(Request $request){
        try {
            $barang = Barang::where('barcode', '=', $request->barcode);
            return response()->json([
                'data' => new BarangResource($barang)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function show($id)
    {
        $barang = Barang::find($id);

        return response()->json([
            'data' => new BarangResource($barang)
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_barang' => 'required',
            'barcode' => 'required',
            'kategori' => 'required',
            'merek' => 'required',
            'stok' => 'required',
            'diskon' => 'max:100',
            'harga_beli' => 'required',
            'harga_jual' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()->first()
            ], 400);
        }

        try {
            
            $barag = Barang::create([
                'barcode' => $request->barcode,
                'nama_barang' => $request->nama_barang,
                'kategori_id' => $request->kategori,
                'merek' => $request->merek,
                'stok' => $request->stok,
                'diskon' => $request->diskon,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Tambah Data Barang berhasil dilakukan'
            ]);

        } catch (\Throwable $th) {
            
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
            
        }
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        $validator = Validator::make($request->all(),[
            'barcode' => 'required',
            'nama_barang' => 'required', 
            'kategori' => 'required',
            'merek' => 'required',
            'stok' => 'required',
            'diskon' => 'required|max:100',
            'harga_beli' => 'required',
            'harga_jual' => 'required' 
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()->first(),
            ], 400);
        }


        try {
            
            $barang->update([
                'barcode' => $request->barcode,
                'nama_barang' => $request->nama_barang,
                'kategori_id' => $request->kategori,
                'merek' => $request->merek,
                'stok' => $request->stok,
                'diskon' => $request->diskon,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Update Data Barang berhasil dilakukan'
            ], 200);
        
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
}
