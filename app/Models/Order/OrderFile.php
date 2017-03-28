<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderFile extends Model
{

	 public function Order()
    {
    	return $this->belongsTo('App\Models\Order\Order','order_id','id');
    }
    
    public function DocumentType()
    {
        return $this->belongsTo('App\Models\Order\DocumentType','document_type','id');
    }

    public function UploadedBy()
    {
        return $this->belongsTo('App\user','user_id','id');
    }
    
}
