<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function index()
    {
        $staff = User::where('role', '!=', 'member')->where('role', '!=', 'admin')->get();

        return view('staff.index', ['menu'=>'staff', 'staff'=>$staff]);
    }

    public function getData($id)
    {
        $staff = User::find($id);

        echo $staff;
    }

    public function store(Request $request)
    {
        // dd($request->foto_profil);
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'foto_profil' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'role' => 'required'
        ]);

        if($validator->fails()){
            return redirect('/staff')->with('error', $validator->messages()->first());
        }

        // $gambar = $this->uploadFoto($request->foto_profil);
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'foto_profil' => $this->uploadFoto($request->foto_profil),
                'tgl_lahir' => new Carbon($request->tgl_lahir),
                'alamat' => $request->alamat,
                'role' => $request->role
            ]);
        } catch (\Throwable $th) {
            return redirect('/staff')->with('error', $th->getMessage());
        }

        return redirect('/staff')->with('status', 'Berhasil menambahkan staff');
    }

    public function update(Request $request, $id)
    {
        if ($request->password == null) {
            $validator = Validator::make($request->all(),[
                'name' => 'required|string',
                'email' => 'required|email',
                'tgl_lahir' => 'required',
                'alamat' => 'required',
                'role' => 'required'
            ]);
    
            if($validator->fails()){
                return redirect('/staff')->with('error', $validator->messages()->first());
            }
        }else {
            $validator = Validator::make($request->all(),[
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'confirmed',
                'tgl_lahir' => 'required',
                'alamat' => 'required',
                'role' => 'required'
            ]);
    
            if($validator->fails()){
                return redirect('/staff')->with('error', $validator->messages()->first());
            }
        }

        $user = User::findOrFail($id);

        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = ($request->passwrod !== null)?Hash::make($request->password):$user->password;
            $user->foto_profil = ($request->foto_profil !== null)?$this->uploadFoto($request->foto_profil):$user->foto_profil;
            $user->tgl_lahir = new Carbon($request->tgl_lahir);
            $user->alamat = $request->alamat;
            $user->role = $request->role;
            $user->save();
        } catch (\Throwable $th) {
            return redirect('/staff')->with('error', $th->getMessage());
        }

        return redirect('/staff')->with('status', 'Berhasil mengupdate data staff');
    }

    public function delete($id)
    {

    }
}
