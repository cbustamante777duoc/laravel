<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function index()
    {
        

        return view('principal')->with([
            'products' => Product::all(),
        ]);
    }
}
