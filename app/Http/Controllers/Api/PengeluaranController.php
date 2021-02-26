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
            'jenis_pengeluaran' => 'required',
            'nominal' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()->first()
            ]);
        }

        try {
            
            Pengeluaran::create([
                'jenis_pengeluaran' => $request->jenis_pengeluaran,
                'nominal' => $request->nominal
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Add Pengeluaran Successfully'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::find($id);

        $validator = Validator::make($request->all(),[
            'jenis_pengeluaran' => 'required',
            'nominal' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()->first()
            ], 400);
        }

        try {
        
            $pengeluaran->update([
                'jenis_pengeluaran' => $request->jenis_pengeluaran,
                'nominal' => $request->nominal
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Update data pengeluaran successfully'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 400);
        }
    }
}
