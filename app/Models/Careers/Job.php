<?php

namespace App\Models\Careers;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function Department()
    {
    	return $this->belongsTo('App\Models\Department\Department','department_id');
    }

    
}
