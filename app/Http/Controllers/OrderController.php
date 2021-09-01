<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\services\CartService;

class OrderController extends Controller
{
    

    public $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //variable es lo mismo que esta en la cookie
        $cart = $this->cartService->getFromCookie();

        //si el carrito no existe o esta vacio
        if (!isset($cart) || $cart->products->isEmpty()) {
            return redirect()
                ->back()
                ->withErrors("Your cart is empty!");
        }

        //retorna una vista con el valor de la variable cart
        return view('orders.create')->with([
            'cart' => $cart,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    
}
