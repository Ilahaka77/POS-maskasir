<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::get();

        return view('supplier.index',['menu' => 'supplier', 'supplier' => $supplier]);
    }

    public function getData($id){
        $supplier = Supplier::find($id);

        echo $supplier;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'no_telepon' => 'required|digits_between:10,13',
            'alamat' => 'required'
        ]);

        if($validator->fails()){
            return redirect('/supplier')->with('error', $validator->messages()->first());
        }

        try {
            Supplier::create([
                'nama_supplier' => $request->name,
                'no_telepon' => $request->no_telepon,
                'alamat' => $request->alamat
            ]);
        } catch (\Throwable $th) {
            return redirect('/supplier')->with('error', $th->getMessage());
        }

        return redirect('/supplier')->with('status', 'Add supplier berhasil');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'no_telepon' => 'required|digits_between:10,13',
            'alamat' => 'required'
        ]);

        if($validator->fails()){
            return redirect('/supplier')->with('error', $validator->messages()->first());
        }

        try {
            $supplier = Supplier::find($id);
            $supplier->nama_supplier = $request->name;
            $supplier->no_telepon = $request->no_telepon;
            $supplier->alamat = $request->alamat;
            $supplier->save();
        } catch (\Throwable $th) {
            return redirect('/supplier')->with('error', $th->getMessage());
        }

        return redirect('/supplier')->with('status', 'Update Supplier berhasil');
    }
}
