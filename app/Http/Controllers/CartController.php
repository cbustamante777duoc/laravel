<?php

namespace App\Http\Controllers;

use App\Cart;
use App\services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //retorna una vista con la cookie cargada
        return view('carts.index')->with([
            'cart' => $this->cartService->getFromCookieOrCreate(),
        ]);
        
    }

    
}
