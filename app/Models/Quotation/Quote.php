<?php

namespace App\Models\Quotation;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
	protected $fillable = [
        'user_id', 'quote_validity', 'status',
    ];

    public function QuoteDetails()
    {
    	return $this->hasMany('App\Models\Quotation\Quotedetail','quote_id','id');
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

    public function QuoteComments()
    {
        return $this->hasMany('App\Models\Quotation\QuoteComment','quote_id','id');
    }

    public function Order()
    {
        return $this->hasOne('App\Models\Order\Order','quote_id','id');
    }


}
