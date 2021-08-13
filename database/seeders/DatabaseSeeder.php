<?php

namespace Database\Seeders;

use App\Cart;
use App\Image;
use App\Order;
use App\Payment;
use App\Product;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
      

       $users = User::factory(20)
               ->create()
               ->each(function($user){
                  //va a crear una imagen de tipo usuario
                  $image = Image::factory()
                     ->user()
                     ->make();
                  //agregamos la imagen a la instacia de user
                  $user->image()->save($image);
               });

       $orders = Order::factory(10)
            ->make()
            ->each(function($order ) use ($users){
               //la insercion de usuario por el campo id (customer_id)
               $order->customer_id =   $users->random()->id;
               $order->save();

               $payment = Payment::factory()->make();

            //    $payment->order_id = $order->id;
            //    $payment->save();

               //se va guardar el pago a una orden
               $order->payment()->save($payment);

            });
            //se crean 20 carritos
            $carts = Cart::factory(20)->create();

            $Product =  Product::factory(23)
               ->create()
               //va agregar ordenes y carritos
               ->each(function($Product) use ($orders, $carts){
                 //va a ser asignado un usarios aletoriamente de los 20 
                  $order = $orders->random();

                  //va a agregar entre 1 y 3 productos de manera aletoria a la orden
                  $order->products()->attach([
                     $Product->id => ['quantity' => mt_rand(1,3)]
                  ]);

                  //va a ser asignado un carrito altoriamente de los 20 
                  $cart = $carts->random();

                  //va a agregar entre 1 y 3 productos de manera aletoria al carrito
                  $cart->products()->attach([
                     $Product->id => ['quantity' => mt_rand(1,3)]
                  ]);

                  //un producto puede tener entre 2 a 4 imagenes
                  $images = Image::factory(mt_rand(2,4))->make();
                  //vamos a guarda un colecion de imagenes a los productos
                  $Product->images()->saveMany($images);
               });

    }
}
