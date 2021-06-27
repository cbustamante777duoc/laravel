<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {   
        //$products = 
        //$products = DB::table('products')->get();
        //dd($products);

        return View('products.index')->with([
            'products' => Product::all(),
        ]);
    }

    public function create()
    {
        return 'this  is the form create a product';
    }

    public function store()
    {
      return 'test message';   
    }    

    public function show($product)
    {
        $product = Product::findOrFail($product);
        //$product = DB::table('products')->where('id',$product)->first();
       // $product = DB::table('products')->find($product);
        //dd($product);
        //return $product;
        return View('products.show')->with([
            'product' => $product,
        ]);
    }

    public function edit($product)
    {

        return "showing form to edit the product with id {$product}";
    }

    public function update($product)
    {

       return "message test";
    }


    public function destroy($product)
    {
     
        return "message test"; 
    }

   
}