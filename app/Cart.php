<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Cart extends Model
{
    protected $fillable = ['ecommerce.mp_response'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'product_id', 'cart_id');
    }
}
