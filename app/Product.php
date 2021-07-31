<?php

namespace App;
use App\Cart;
use App\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'status'
    ];

    //metodo para acceder carro de compras
    public function carts()
    {
        return $this->belongsToMany(Cart::class)->withPivot('quantity');

    }

    //metodo para acceder a ordenes
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');

    }
}
