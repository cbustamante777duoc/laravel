<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;


class ProductController extends Controller
{

   public function __construct()
   {
       $this->middleware('auth');
   }


    public function index()
    {   
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
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return redirect()
            ->route('products.index')
            ->withSuccess("The new product with id {$product->id} was created");
        // ->with(['success' => "The new product with id {$product->id} was created"]);
    }


    //recibe un producto id y muestra todos los valores
    public function show(Product $product)
    {
        //$product = Product::findOrFail($product);
        return View('products.show')->with([
            'product' => $product,
        ]);
    }

    //metodo que retorna una instacia del producto enviado en el id
    public function edit(Product $product)
    {
        return view('products.edit')->with([
           // 'product' => Product::findOrFail($product),
           'product' => $product
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()
            ->route('products.index')
            ->withSuccess("The product with id {$product->id} was edited");
    }


    public function destroy(Product $product)
    {
     
        //$product = Product::findOrFail($product);
        $product -> delete();

        return redirect()
            ->route('products.index');
          
    }

   
}