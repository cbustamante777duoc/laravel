<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductCartController extends Controller
{
    public $cartService;

    //inyecion de depencia
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $cart = $this->cartService->getFromCookieOrCreate();

        //filtra por id / pivot = claves foreaneas / quantity cantidad primera ves cera 0
        $quantity = $cart->products()
            ->find($product->id)
            ->pivot
            ->quantity ?? 0;

        //cada ves que el usario pincha sobre el enlace del producto se agrega un al carrito
        //metodo attach es como agregar pero necesita una cantidad
        $cart->products()->syncWithoutDetaching([
            $product->id => ['quantity' => $quantity + 1],
        ]);

        $cookie = $this->cartService->makeCookie($cart);
        

        return redirect()->back()->cookie($cookie);
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
        //eliminar el producto
        $cart->products()->detach($product->id);

        //consumo de servicio
        $cookie = $this->cartService->makeCookie($cart);

        return redirect()->back()->cookie($cookie);
    }

  
}
