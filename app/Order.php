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

    public function payment()
    {

        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        //referenciando el customer_id es la id del usuario
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');

    }
}
