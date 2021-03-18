<?php

namespace App\Http\Controllers;

use App\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluaran = Pengeluaran::all();

        return view('pengeluaran.index',['menu'=>'pengeluaran', 'pengeluaran'=>$pengeluaran]);
    }

    public function getData($id)
    {
        $pengeluaran = Pengeluaran::find($id);

        echo $pengeluaran;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_pengeluaran' => 'required',
            'nominal' => 'required'
        ]);

        if($validator->fails()){
            return redirect('/pengeluaran')->with('error', $validator->messages()->first());
        }

        try {
            Pengeluaran::create([
                'jenis_pengeluaran' => $request->jenis_pengeluaran,
                'nominal' => $request->nominal
            ]);
        } catch (\Throwable $th) {
            return redirect('/pengeluaran')->with('error', $th->getMessage());
        }

        return redirect('/pengeluaran')->with('status', 'Add Pengeluaran Berhasil');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jenis_pengeluaran' => 'required',
            'nominal' => 'required'
        ]);

        if($validator->fails()){
            return redirect('/pengeluaran')->with('error', $validator->messages()->first());
        }

        try {
            $pengeluaran = Pengeluaran::find($id);
            $pengeluaran->update([
                'jenis_pengeluaran' => $request->jenis_pengeluaran,
                'nominal' => $request->nominal
            ]);
        } catch (\Throwable $th) {
            return redirect('/pengeluaran')->with('error', $th->getMessage());
        }

        return redirect('/pengeluaran')->with('status', 'Update Pengeluaran Berhasil');
    }
}
