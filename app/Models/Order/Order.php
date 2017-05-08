<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function OrderProducts()
    {
    	return $this->hasMany('App\Models\Order\OrderProduct','order_id','id');
    }

    public function User()
    {
    	return $this->belongsTo('App\User');
    }

    public function AssignedTo()
    {
        return $this->belongsTo('App\User','assign_to_id','id');
    }

    public function Status()
    {
        return $this->belongsTo('App\Models\Status\Status','status','id');
    }

    public function Quote()
    {
        return $this->hasOne('App\Models\Quotation\Quote','id','quote_id');
    }


    public function OrderComments()
    {
        return $this->hasMany('App\Models\Order\OrderComment','order_id','id');
    }

    public function OrderFiles()
    {
        return $this->hasMany('App\Models\Order\OrderFile','order_id','id');
    }

    public function OrderShipments()
    {
        return $this->hasMany('App\Models\Order\OrderShipment','order_id','id');
    }
    

     public function Rating()
    {
        return $this->belongsTo('App\Models\Rating\Rating','order_id','id');
    }
    
}
