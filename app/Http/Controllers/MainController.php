<?php

namespace App\Http\Controllers;

use App\Product;

class MainController extends Controller
{
    public function index()
    {
        //consulta que traiga todos los productos que tengan un status available
        $products = Product::available()->get();

        return view('welcome')->with([
            'products' => $products,
        ]);
    }
}