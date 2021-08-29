<?php

namespace App\services;

use App\Cart;
use Illuminate\Support\Facades\Cookie;

class CartService
{


    protected $cookieName = 'cart';

    public function getFromCookieOrCreate()
    {
        
        //nombre de la cookie
        $cartId = Cookie::get($this->cookieName);
       //encuentra el id de la cookie 
        $cart = Cart::find($cartId);
       //sino crealo
        return $cart ?? Cart::create();
    }

    public function makeCookie(Cart $cart)
    {
        return Cookie::make($this->cookieName , $cart->id, 7 * 24 * 60);
    }
}