<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    
    public function index()
    {
        $pembelian = DB::table('pembelians')
            ->select('pembelians.created_at as tanggal', 'suppliers.nama_supplier', 'pembelians.total_bayar')
            ->join('suppliers', 'pembelians.supplier_id', '=', 'suppliers.id')
            ->get();

        return response()->json([
            'data' => $pembelian
        ],200);
    }
}
