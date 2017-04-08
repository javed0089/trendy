<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderShipmentFiles extends Model
{
    protected $table = 'order_shipment_files';


     public function Ordershipment()
    {
    	return $this->belongsTo('App\Models\Order\OrderShipment','order_shipment_id','id');
    }
}
