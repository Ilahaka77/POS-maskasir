<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $kategori = Category::all();

        return response()->json([
            'data' => $kategori
        ], 200);
    }

    public function create(Request $request){
        
        $validator = Validator::make($request->all(),[
            'kategori' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()->first()
            ], 400);
        }

        try {
            
            Category::create([
                'kategori' => $request->kategori
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Add Category is successfully'
            ], 200);

        } catch (\Throwable $th) {
            
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 201);
        }
    }
}
