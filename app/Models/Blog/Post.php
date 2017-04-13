<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    public function BlogCategory()
    {
    	return $this->belongsTo('App\Models\Blog\BlogCategory','blog_category_id','id');
    }
    public function tags()
    {
    	return $this->belongsToMany('App\Models\Blog\Tag');
    }
    public function comments()
    {
    	return $this->hasMany('App\Models\Blog\Comment');
    }

}
