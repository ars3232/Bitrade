<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity', // Assuming there's a quantity field in your orders table
        'price', // Assuming price is stored per order
        // other fields...
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
}
