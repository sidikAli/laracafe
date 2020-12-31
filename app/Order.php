<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function cart()
    {
    	return $this->belongsTo(Cart::class);
    }

    public function order_details()
    {
    	return $this->hasMany(Order_detail::class);
    }
}
