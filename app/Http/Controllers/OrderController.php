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
        //protegiendo que el usuario este conectado
        $this->middleware('auth');

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
        $user = $request->user();

        //crea un orden
        $order = $user->orders()->create([
            'status' => 'pending',
        ]);

        //envio todos los productos de la cookie
        $cart = $this->cartService->getFromCookie();

        $cartProductWithQuantity = $cart
            ->products
            //funcion que va a aguardar el el producto por id con la cantidad que esta en la tabla pivot
            ->mapWithKeys(function($product){
                $element[$product->id] = ['quantity' => $product->pivot->quantity];

                return $element;
            });

            //dd($cartProductWithQuantity);
            //mapWithKeys entrega un arreglo entonce se debe convertir a un arreglo 
            $order->products()->attach($cartProductWithQuantity->toArray());

    }

    
}
