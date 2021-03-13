<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function index()
    {
        $staff = User::where('role', '!=', 'member')->where('role', '!=', 'admin')->get();

        return view('staff.index', ['menu'=>'staff', 'staff'=>$staff]);
    }

    public function show($id)
    {
        $staff = User::where('id', $id)->first();

        return view('staff.detail', ['menu'=>'staff', 'staff'=>$staff]);
    }

    public function getData($id)
    {
        $staff = User::find($id);

        echo $staff;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'role' => 'required'
        ]);

        if($validator->fails()){
            
        }
    }
}
