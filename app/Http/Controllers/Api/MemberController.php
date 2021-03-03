<?php

namespace App\Http\Controllers\Api;

use App\ApiUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{

    public function index(){
        $user = ApiUser::where('role', '=', 'member')->get();

        return response()->json([
            'data' => MemberResource::collection($user)
        ]);
    }

    public function show($id)
    {
        $user = ApiUser::find($id);
        return response()->json([
            'data' => new MemberResource($user)
        ]);
        
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'foto_profil' => 'required|image',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()->first()
            ]);
        }

        $gambar = $this->uploadFoto($request->foto_profil);
        $user = ApiUser::create([
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

        return response()->json([
            'status' => 'success',
            'message' => 'Add member successfully'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'foto_profil' => 'image',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()->first()
            ]);
        }

        $user = ApiUser::find($id);
        $gambar = ($request->foto_profil !== null)?$this->uploadFoto($request->foto_profil):'https://via.placeholder.com/150';

        try {

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => ($request->password == null)?$user->password : Hash::make($request->password),
                'foto_profil' => $gambar,
                'tgl_lahir' => new Carbon($request->tgl_lahir),
                'alamat' => $request->alamat
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Update data successfully'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 400);
        }
    }

    public function getKodeMember(){
        $year = date("Y");
        $data = count(DB::table('members')->whereYear('created_at', $year)->get());

        return 'M'.$year.$data+1;
    }
}
