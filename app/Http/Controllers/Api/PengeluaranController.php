<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluaran = Pengeluaran::all();

        return response()->json([
            'data' => $pengeluaran
        ], 200);
    }

    public function show($id)
    {
        $pengeluaran = Pengeluaran::find($id);

        return response()->json([
            'data' => $pengeluaran
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[

        ]);
    }
}
