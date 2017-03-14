<?php

namespace App\Models\blog;

use Illuminate\Database\Eloquent\Model;


class BlogCategory extends Model
{
    public function Posts()
    {
    	return $this->hasMany('App\Models\blog\Post','blog_category_id','id');
    }
}
