<?php

namespace App\Http\Controllers\Api;

use App\Barang;
use App\DetailPembelian;
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
        $transaksi = Transaksi::get();

        return response()->json([
            'data' => $transaksi
        ], 200);
    }

    public function show($id)
    {
        $transaksi = DB::table('transaksis')->select('kode_transaksi', 'created_at as tanggal','kasir')->where('kode_transaksi', $id)->first();
        $detail = DB::table('detail_transaksis')
            ->select('detail_transaksis.id', 'barangs.barcode', 'barangs.nama_barang', 'categories.kategori', 'barangs.merek', 'barangs.harga_jual', 'detail_transaksis.jumlah', 'barangs.harga_jual', 'detail_transaksis.harga')
            ->where('detail_transaksis.kode_transaksi', '=' , $id)
            ->leftJoin('barangs', 'detail_transaksis.barang_id', '=', 'barangs.id')->get();

        return response()->json([
            'transaksi' => $transaksi,
            'detail' => $detail
        ], 200);
    }

    public function newTransaksi()
    {
        // dd($this->getKodeTransaksi());
        $transaksi = Transaksi::create([
            'kode_transaksi' => $this->getKodeTransaksi(),
            'harga_total' => 0,
            'kasir' => Auth::user()->id
        ]);

        return response()->json([
            'data' => $transaksi
        ], 200);
    }

    public function add(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'barang' => 'required',
            'jumlah' => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()->first()
            ],200);
        }

        try {
            $item = Barang::find($request->barang);
            $detail = DetailTransaksi::create([
                'kode_transaksi' => $id,
                'barang_id' => $request->barang,
                'jumlah' => $request->jumlah,
                'harga' => $request->jumlah*$item->harga_jual
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 200);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => 'Add item transaction is successfully',
        ], 200);
    }

    public function updateItem(Request $request, $id)
    {
        $detail = DetailTransaksi::find($id);
        $barang = Barang::find($detail->barang_id);
        $detail->update([
            'jumlah' => $request->jumlah,
            'harga' => $request->jumlah*$barang->harga_jual
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Update detail is success',
        ], 200);
    }

    public function deleteItem($id)
    {
        $detail = DetailTransaksi::find($id);
        $detail->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'deleting detail is success'
        ], 200);
    }

    public function getHarga(Request $request, $id){
        
        if($request->kode_member !== null){

            $detail = DetailTransaksi::where('kode_transaksi', $id)->get();
            $transaksi = Transaksi::where('kode_transaksi', $id)->first();
            if($request->kode_member !== null){
                foreach ($detail as $key => $value) {
                    $barang = Barang::find($value->barang_id);
                    $update = DetailTransaksi::where('id', $value->id)->update([
                        'harga' => $value->harga - ($value->harga * $barang->diskon)
                    ]);
                    $transaksi->harga_total = $transaksi->harga_total + $update->harga;
                }
                $transaksi->kode_member = $request->kode_member;
                $transaksi->save();
    
                return response()->json([
                    'transaksi' => $transaksi
                ]);
            }
        }

        return response()->json([
            'transaksi' => $transaksi
        ]);
        
    }

    public function bayar(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'bayar' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()->first()
            ], 400);
        }

        $transaksi = Transaksi::where('kode_transaksi', $id)->first();

        $transaksi->bayar = $request->bayar;
        $transaksi->kembalian = $request->bayar - $transaksi->harga_total;
        $transaksi->save();

        return response()->json([
            'kembalian' => $transaksi->kembalian
        ], 200);
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
