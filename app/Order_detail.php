<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
	protected $table = 'order_details';
	
    protected $guarded = [];

    public function order()
    {
    	return $this->belongsTo('App\Order');
    }
    
    public function food()
    {
    	return $this->belongsTo('App\Food');
    }

}
