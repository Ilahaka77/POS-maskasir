<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

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

        return view('profil', compact('data'));
    }

    public function editPhoto(Request $request, $id){
        $user = User::find($id);

        $user->update([
            'foto_profil' => $this->uploadFoto($request->foto_profil)
        ]);

        return redirect('/profil')->with('status', 'Foto Profil berhasil diubah');

    }
    
}
