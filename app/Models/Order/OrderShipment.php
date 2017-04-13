<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderShipment extends Model
{
	protected $table = 'order_shipments';

     public function Order()
    {
    	return $this->belongsTo('App\Models\Order\Order','order_id','id');
    }

    public function OrderShipmentStatus()
    {
        return $this->belongsTo('App\Models\Order\OrderShipmentStatus','order_shipment_status_id','id');
    }

    public function OrderShipmentFiles()
    {
        return $this->hasMany('App\Models\Order\OrderShipmentFiles','order_shipment_id','id');
    }
   
}
