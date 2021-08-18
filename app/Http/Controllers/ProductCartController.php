<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;

class ProductCartController extends Controller
{
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $cart = Cart::create();
        //filtra por id / pivot = claves foreaneas / quantity cantidad primera ves cera 0
        $quantity = $cart->products()
            ->find($product->id)
            ->pivot
            ->quantity ?? 0;

        //cada ves que el usario pincha sobre el enlace del producto se agrega un al carrito
        //metodo attach es como agregar pero necesita una cantidad
        $cart->products()->attach([
            $product->id => ['quantity' => $quantity +1],
        ]);

        return redirect()->back();
    }

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Cart $cart)
    {
        //
    }
}
