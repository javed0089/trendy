<?php

namespace App\Models\blog;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
    	return $this->belongsToMany('App\Models\blog\Post');
    }}
