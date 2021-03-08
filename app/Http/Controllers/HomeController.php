<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function show(){
        $data = User::find(Auth::user()->id);
        // dd($data);
        return view('profil', compact('data'));
    }

    public function editPhoto(Request $request, $id){
        $user = User::find($id);

        $user->update([
            'foto_profil' => $this->uploadFoto($request->foto_profil)
        ]);

        return redirect('/profil')->with('status', 'Foto Profil berhasil diubah');

    }

    public function getdata($id)
    {
        $user = User::findOrFail($id);

        echo $user;
    }
    
    public function editProfil(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required'
        ]);

        if($validator->fails()) {
            return redirect('/profil')->with('status', $validator->errors()->first());
        }

        $user = User::find(Auth::user()->id);

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'tgl_lahir' => new Carbon($request->tgl_lahir),
                'alamat' => $request->alamat
            ]);
        } catch (\Throwable $th) {
            return redirect('/profil')->with('status', $th->getMessage());
        }

        return redirect('/profil')->with('status', 'Successfully edit your profil');

    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8'
        ]);

        $data = User::find(Auth::user()->id);

        if(!Hash::check($request->old_password, $data->password)){
            return redirect('/profil')->with('status', 'Password lama yang anda inputkan salah');
        }
        if($validator->fails()) {
            return redirect('/profil')->with('status', $validator->errors()->first());
        }

        $data->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect('/profil')->with('status', "Password berhasil diubah");
    }
}
