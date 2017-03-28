<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public function Order()
    {
    	return $this->belongsTo('App\Models\Order\Order','order_id','id');
    }

    public function Product()
    {
    	return $this->belongsTo('App\Models\Product\Product','product_id','id');
    }

 
}
