<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index(){
        $supplier = Supplier::all();

        return response()->json([
            'data' => $supplier
        ], 200);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_supplier' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'no_telepon' => ['required', 'digits_between:10,13']
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()->first()
            ],400);
        }

        try {
            $supplier = Supplier::create([
                'nama_supplier' => $request->nama_supplier,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon
            ]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Add supplier is successfully',
                'data' => $supplier
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 201);
        }

    }

    public function show($id){

        $supplier = Supplier::find($id);

        return response()->json([
            'data' => $supplier
        ], 200)
    }

    public function update(Request $request, $id){
        
        $supplier = Supplier::find($id);


        
    }
}
