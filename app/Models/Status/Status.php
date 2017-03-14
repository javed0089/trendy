<?php

namespace App\Models\Status;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function Quotes()
    {
        return $this->hasMany('App\Models\Quotation\Quote','status','id');
    }
}
