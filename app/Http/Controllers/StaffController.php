<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
}
