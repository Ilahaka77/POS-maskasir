<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::get();

        return view('supplier.index',['menu' => 'supplier', 'supplier' => $supplier]);
    }
}
