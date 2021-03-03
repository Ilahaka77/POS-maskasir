<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Http\Resources\StaffResource;
use App\Member;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto_profil' => 'https://via.placeholder.com/150',
            'role' => 'member'
        ]);
        
        $member = Member::create([
            'user_id' => $user->id,
            'kode_member' => $this->getKodeMember(),
            'saldo' => 0
        ]);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json([
            'data' => new MemberResource($user),
            'token' => $accessToken
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->only('email', 'password'),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        if(! auth()->attempt($request->only('email', 'password'))){
            return response(['message' => 'Invalid Credential']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        if(auth()->user()->role == 'member'){
            return response()->json([
                'data' => new MemberResource(auth()->user()),
                'token' => $accessToken
            ],200);
        }else{
            return response()->json([
                'data' => new StaffResource(auth()->user()),
                'token' => $accessToken
            ],200);
        }
    }

    public function profil(){
        $user = auth('api')->user();
        return new MemberResource($user);
    }

    public function editProfil(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'foto_profil' => 'image',
            'tgl_lahir' => 'required',
            'alamat' => 'required'
        ]);
        // dd(auth()->user());
        if($validator->fails()){
            return response()->json($validator->errors()->first());
        }

        $gambar = ($request->foto_profil !== null)?$this->uploadFoto($request->foto_profil):'https://via.placeholder.com/150';
        $user = User::find(Auth::id());
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'foto_profil' => $gambar,
                'tgl_lahir' => new Carbon($request->tgl_lahir),
                'alamat' => $request->alamat
            ]);
    
            return response()->json([
                'status' => 'Update Successfully',
                'data' => new MemberResource($user)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Update Failed',
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors()->first());
        }

        $user = User::find(Auth::id());

        if(!Hash::check($request->oldPassword, $user->password)){
            return response()->json([
                'status' => 'error',
                'message' => 'Password lama yang dimasukkan salah'
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => 'Change Password successfully'
        ]);

    }

    public function getKodeMember(){
        $year = date("Y");
        $data = count(DB::table('members')->whereYear('created_at', $year)->get());

        return 'M'.$year.$data+1;
    }
}
