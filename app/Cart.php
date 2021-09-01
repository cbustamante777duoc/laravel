<?php

namespace App;
use App\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    //metodo para acceder a los productos  relaciones polimorficas
    public function products()
    {
        return $this->morphToMany(Product::class,'productable')->withPivot('quantity');

    }

    //metodo que multiplica el total (getTotalAttribute()) y los suma 
    public function getTotalAttribute()
    {
        return $this->products->pluck('total')->sum();
    }
}
