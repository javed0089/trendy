<?php

namespace App\Models\Rating;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function User()
    {
    	return $this->belongsTo('App\User');
    }
}
