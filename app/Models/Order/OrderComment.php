<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderComment extends Model
{
    public function Order()
    {
    	return $this->belongsTo('App\Models\Order\Order','order_id','id');
    }

    public function User()
    {
    	return $this->belongsTo('App\User');
    }
}
