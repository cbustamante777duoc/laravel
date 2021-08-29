<?php

namespace App\services;

use App\Cart;
use Illuminate\Support\Facades\Cookie;

class CartService
{


    protected $cookieName = 'cart';


    public function getFromCookie()
    {
        //nombre de la cookie
        $cartId = Cookie::get($this->cookieName);
       //encuentra el id de la cookie 
        $cart = Cart::find($cartId);

        return $cart;

    }

    public function getFromCookieOrCreate()
    {
        //variable igual a la funcion
        $cart = $this->getFromCookie();

       //sino existe el carrito lo crea
        return $cart ?? Cart::create();
    }

    public function makeCookie(Cart $cart)
    {
        return Cookie::make($this->cookieName , $cart->id, 7 * 24 * 60);
    }

    public function countProducts()
    {
        $cart = $this->getFromCookie();

        if ($cart != null) {
            //metodo que cuenta cuantos productos hay en el carrito
            return $cart->products->pluck('pivot.quantity')->sum();
        }

        return 0;
    }
}