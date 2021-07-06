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

    //retorna una vista de formulario
    public function create()
    {
        return view('products.create');
        
    }

    //recibe los datos del formulario create y los guarda en db 
    public function store()
    {
        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];

        request()->validate($rules);

        //pregunta si el el producto esta disponible pero tiene stock o 
      
      if (request()->status=='available' && request()->stock == 0) {
          //session()->put('error','if available must have stock');
            session()->flash('error','if available must have stock');

          return redirect()->back();
      }

       //metodo request()all() = todas las filas del model
       $product = Product::create(request()->all());
       return redirect()->route('products.index');
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

        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];

        request()->validate($rules);

       $product = Product::findOrFail($product);
       $product -> update(request()->all());

       return redirect()->route('products.index');
    }


    public function destroy($product)
    {
     
        $product = Product::findOrFail($product);
        $product -> delete();

        return redirect()->route('products.index');
    }

   
}