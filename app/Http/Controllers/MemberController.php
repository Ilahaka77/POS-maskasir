<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index()
    {
        $member = DB::table('users')->select('members.kode_member', 'users.*')
            ->where('users.role', '=', 'member')
            ->leftJoin('members', 'members.user_id', '=', 'users.id')
            ->get();
        return view('member.index', ['menu'=> 'member','member'=> $member]);
    }

    public function show($id)
    {
            $member = User::select('users.*', 'members.kode_member')->where('users.id', $id)->join('members', 'members.user_id', '=', 'users.id')->first();

        echo $member;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'foto_profil' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'tgl_lahir' => 'required',
            'alamat' => 'required'
        ]);

        if($validator->fails()){
            return redirect('/member')->with('error', $validator->messages()->first());
        }

        try {
            $gambar = $this->uploadFoto($request->foto_profil);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto_profil' => $gambar,
            'tgl_lahir' => new Carbon($request->tgl_lahir),
            'alamat' => $request->alamat,
            'role' => 'member',
        ]);

        Member::create([
            'user_id' => $user->id,
            'kode_member' => $this->getKodeMember(),
            'saldo' => 0                    
        ]);
        } catch (\Throwable $th) {
            return redirect('/member')->with('error', $th->getMessage());
        }

        return redirect('/member')->with('satus', 'Berhasil menambahkan member');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required' 
        ]);

        if($validator->fails()){
            return redirect('/member')->with('error', $validator->messages()->first());
        }

        $user = User::find($id);
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->tgl_lahir = $request->tgl_lahir;
            $user->alamat = $request->alamat;
            $user->foto_profil = ($request->foto_profil == null)?$user->foto_profil:$this->uploadFoto($request->foto_profil);
            $user->save();
        } catch (\Throwable $th) {
            return redirect('/member')->with('error', $th->getMessage());
        }

        return redirect('/member')->with('status', 'Edit Member berhasil');
    }

    public function getKodeMember(){
        $year = date("Y");
        $data = count(DB::table('members')->whereYear('created_at', $year)->get());

        return 'M'.$year.$data+1;
    }
}
