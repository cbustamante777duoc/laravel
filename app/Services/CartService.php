<?php

namespace App\services;

use App\Cart;
use Illuminate\Support\Facades\Cookie;

class CartService
{
    public function getFromCookieOrCreate()
    {
        
        //nombre de la cookie
        $cartId = Cookie::get('cart');
       //encuentra el id de la cookie 
        $cart = Cart::find($cartId);
       //sino crealo
        return $cart ?? Cart::create();
    }
}