<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Member;
use App\User;
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
            'role' => 'member'
        ]);
        
        $member = Member::create([
            'user_id' => $user->id,
            'kode_member' => $this->getKodeMember()
        ]);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json([
            'data' => $user,
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

        return response()->json([
            'data' => auth()->user(),
            'token' => $accessToken
        ]);
    }

    public function profil(){
        $user = User::with('member')->find(Auth::id());
        return response()->json([
            'data' => $user
        ]);
    }

    public function getKodeMember(){
        $year = date("Y");
        $data = count(DB::table('members')->whereYear('created_at', $year)->get());

        return 'M'.$year.$data+1;
    }
}
