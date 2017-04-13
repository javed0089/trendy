<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;


class BlogCategory extends Model
{
    public function Posts()
    {
    	return $this->hasMany('App\Models\Blog\Post','blog_category_id','id');
    }
}
