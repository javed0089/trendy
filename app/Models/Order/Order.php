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
        return $this->hasOne('App\Models\Quotation\Quote','quote_id','id');
    }


    public function OrderComments()
    {
        return $this->hasMany('App\Models\Order\OrderComment','order_id','id');
    }

    public function OrderFiles()
    {
        return $this->hasMany('App\Models\Order\OrderFile','order_id','id');
    }
    
    
}
