<?php

namespace App\Http\Controllers\Api;

use App\Barang;
use App\DetailTransaksi;
use App\Http\Controllers\Controller;
use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{

    public function index()
    {
        $transaksi = Transaksi::all();

        return response()->json([
            'data' => $transaksi
        ], 200);
    }
    public function newTransaksi()
    {
        // dd($this->getKodeTransaksi());
        $transaksi = Transaksi::create([
            'kode_transaksi' => $this->getKodeTransaksi(),
            'kasir' => Auth::user()->id
        ]);

        return response()->json([
            'data' => $transaksi
        ], 200);
    }

    public function add(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'penjualan.*.barang' => 'required',
            'penjualan.*.jumlah' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()->first()
            ],200);
        }

        $barang = $request->penjualan;

        $transaksi = [];
        foreach ($barang as $key => $value) {
            $item = Barang::find($value['barang']);
            $transaksi[$key] = DetailTransaksi::create([
                'kode_transaksi' => $id,
                'barang_id' => $value['barang'],
                'jumlah' => $value['jumlah'],
                'harga' => $item->harga_jual*$value['jumlah']
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Add item transaction is successfully',
            'data' => $transaksi
        ], 200);
    }

    public function bayar(Request $request, $id){

    }

    public function cencel($id)
    {
        $transaksi = Transaksi::where('kode_transaksi', $id)->first();
        $transaksi->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Success to cencel transaction'
        ], 200);
    }

    public function getKodeTransaksi(){
        $date = Carbon::today();
        $data = count(DB::table('transaksis')->whereYear('created_at', $date)->get());

        return 'T'.$date->format("Ymd").$data+1;

    }
}
