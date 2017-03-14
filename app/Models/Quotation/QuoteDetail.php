<?php

namespace App\Models\Quotation;

use Illuminate\Database\Eloquent\Model;

class QuoteDetail extends Model
{


    public function Quote()
    {
    	return $this->belongsTo('App\Models\Quotation\Quote','quote_id','id');
    }

    public function Product()
    {
    	return $this->belongsTo('App\Models\Product\Product','product_id','id');
    }

    public function Status()
    {
        return $this->belongsTo('App\Models\Status\Status','status','id');
    }
}
