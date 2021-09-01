<?php

namespace App;
use App\Payment;
use App\User;
use App\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'customer_id',
    ];

    //metodo para acceder a los pagos
    public function payment()
    {

        return $this->hasOne(Payment::class);
    }

    //metodo para acceder a los usuarios
    public function user()
    {
        //referenciando el customer_id es la id del usuario
        return $this->belongsTo(User::class, 'customer_id');
    }

    //metodo para acceder a los productos  relaciones polimorficas
    public function products()
    {
        return $this->morphToMany(Product::class,'productable')->withPivot('quantity');

    }

    //metodo que multiplica el total (getTotalAttribute()) y lo suma 
    public function getTotalAttribute()
    {
        return $this->products->pluck('total')->sum();
    }

   
}
