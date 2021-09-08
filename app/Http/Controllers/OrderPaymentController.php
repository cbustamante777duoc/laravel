<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use App\services\CartService;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{
    public $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function create(Order $order)
    {
        return view('payments.create')->with([
            'order' => $order,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        $this->cartService->getFromCookie()->products()->detach();

        //crea una pago con los atributos
        $order->payment()->create([
            'amount' => $order->total,
            'payed_at' => now(),

        ]);

        //cambia el atributo de la orden a pagado
        $order->status = 'payed';
        //guarda en base de datos
        $order->save();

        return redirect()
            ->route('main')
            ->withSuccess("thank! Your payment is for {$order->total} was successful");


    }

}
