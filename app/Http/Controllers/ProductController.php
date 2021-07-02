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
      
        return View('products.index')->with([
            'products' => Product::all(),
        ]);
    }

    public function create()
    {
        return view('products.create');
        
    }

    //metodo que recibe las fillable
    public function store()
    {
        /*$product = Product::create([
            'title' => request()->title,
            'description' => request()->description,
            'price' =>  request()->price,
            'stock' => request()->stock,
            'status' => request()->status,
        ]);*/
       
       $product = Product::create(request()->all());
       return $product;
    }    

    //recibe un id y muestra un producto
    public function show($product)
    {
        //$product = DB::table('products')->where('id',$product)->first();
       // $product = DB::table('products')->find($product);
         $product = Product::findOrFail($product);
        return View('products.show')->with([
            'product' => $product,
        ]);
    }

    //metodo que retorna una instacia del producto enviado en el id
    public function edit($product)
    {
        return view('products.edit')->with([
            'product' => Product::findOrFail($product),
        ]);
    }

    public function update($product)
    {
       $product = Product::findOrFail($product);
       $product -> update(request()->all());

       return $product;
    }


    public function destroy($product)
    {
     
        $product = Product::findOrFail($product);
        $product -> delete();

        return $product;
    }

   
}