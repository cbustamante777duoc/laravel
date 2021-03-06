<?php

namespace App;
use App\Cart;
use App\Order;
use App\Image;
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

    //metodo para acceder carro de compras relaciones polimorficas
    public function carts()
    {
        return $this->morphedByMany(Cart::class,'productable')->withPivot('quantity');

    }

    //metodo para acceder a ordenes  relaciones polimorficas
    public function orders()
    {
        return $this->morphedByMany(Order::class,'productable')->withPivot('quantity');

    }

    //establecion la relacion uno a mucho con imagenes (poliforfica)
    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }

    //consulta que trae todos los los productos disponibles
    public function scopeAvailable($query)
    {
       $query->where('status','available');
    }

    //metodo que multiplica la cantidad por el precio y retorna el total
    public function getTotalAttribute()
    {
        return $this->pivot->quantity * $this->price;
    }

    
}
