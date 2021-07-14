<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function store()
    {
        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];

        //se agregan las validaciones
        request()->validate($rules);

        //pregunta si el el producto esta disponible pero tiene stock o 
      
      if (request()->status=='available' && request()->stock == 0) {
        
        // session()->flash('error','if available must have stock');

         //envio con todos los valores que se enviaron
          return redirect()
                    ->back()
                    ->withInput(request()->all())
                    ->withErrors('if available must have stock');

      }

       //metodo request()all() = todas las filas del model
       $product = Product::create(request()->all());
       
       
       return redirect()
            ->route('products.index')
            ->withSuccess("the new product with id {$product->id} was created");
    }       



    //recibe un producto id y muestra todos los valores
    public function show($product)
    {
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

       return redirect()
         ->route('products.index')
         ->withSuccess("the product with id {$product->id} was updated");
    }


    public function destroy($product)
    {
     
        $product = Product::findOrFail($product);
        $product -> delete();

        return redirect()
            ->route('products.index')
            ->withSuccess("the  product with id {$product->id} was deleted");
    }

   
}