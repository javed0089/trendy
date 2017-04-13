<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post()
    {
    	return $this->belongsTo('App\Models\Blog\Post');
    }}
