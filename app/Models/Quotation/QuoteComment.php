<?php

namespace App\Models\Quotation;

use Illuminate\Database\Eloquent\Model;

class QuoteComment extends Model
{
    public function Quote()
    {
    	return $this->belongsTo('App\Models\Quotation\Quote','quote_id','id');
    }

    public function User()
    {
    	return $this->belongsTo('App\User');
    }
}
