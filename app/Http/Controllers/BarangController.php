<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::select('barangs.*', 'categories.kategori as kategori')->join('categories', 'barangs.kategori_id', '=', 'categories.id')->get();
        $kategori = Category::all();

        return view('barang.index', ['menu'=>'barang', 'barang' => $barang, 'kategori' => $kategori]);
    }

    public function getData($id)
    {
        $barang = Barang::select('barangs.*', 'categories.kategori as kategori')->where('barangs.id','=', $id)->join('categories', 'barangs.kategori_id', '=', 'categories.id')->first();
        echo $barang;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_barang' => 'required',
            'barcode' => 'required',
            'kategori' => 'required',
            'merek' => 'required', 
            'stok' => 'required',
            'diskon' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required'
        ]);

        if($validator->fails()){
            return redirect('/barang')->with('error', $validator->messages()->first());
        }

        try {
            Barang::create([
                'barcode' => $request->barcode,
                'nama_barang' => $request->nama_barang,
                'kategori_id' => $request->kategori,
                'merek' => $request->merek,
                'stok' => $request->stok,
                'diskon' => $request->diskon,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
            ]);
        } catch (\Throwable $th) {
            return redirect('/barang')->with('error', $th->getMessage());
        }

        return redirect('/barang')->with('status', 'Add barang berhasil');
    }
}
