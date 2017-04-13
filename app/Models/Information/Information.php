<?php

namespace App\Models\Information;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
	protected $table = 'informations';

    public function InformationType()
    {
        return $this->belongsTo('App\Models\Information\InformationType','information_type_id','id');
    }
}
