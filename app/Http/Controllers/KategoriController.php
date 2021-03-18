<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Category::all();

        return view('kategori.index', ['menu' => 'kategori', 'kategori'=> $kategori]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kategori' => 'required'
        ]);
        
        if($validator->fails()){
            return redirect('/kategori')->with('error', $validator->messages()->first());
        }

        try {
            Category::create([
                'kategori' => $request->kategori
            ]);
        } catch (\Throwable $th) {
            return redirect('/kategori')->with('error', $th->getMessage());
        }

        return redirect('/kategori')->with('status', 'Add Kategori berhasil');
    }

    public function getData($id)
    {
        $kategori = Category::find($id);
        echo $kategori;
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'kategori' => 'required'
        ]);
        
        if($validator->fails()){
            return redirect('/kategori')->with('error', $validator->messages()->first());
        }

        try {
            $kategori = Category::find($id);
            $kategori->update([
                'kategori' => $request->kategori
            ]);
        } catch (\Throwable $th) {
            return redirect('/kategori')->with('error', $th->getMessage());
        }
        
        return redirect('/kategori')->with('status', 'Edit Kategori berhasil');
    }
}
