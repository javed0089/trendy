<?php

namespace App\Models\blog;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post()
    {
    	return $this->belongsTo('App\Models\blog\Post');
    }}
