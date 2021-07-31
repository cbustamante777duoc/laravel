<?php

namespace App;
use App\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    //metodo para acceder a los productos
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');

    }
}
