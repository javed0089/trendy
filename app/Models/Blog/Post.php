<?php

namespace App\Models\blog;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    public function BlogCategory()
    {
    	return $this->belongsTo('App\Models\blog\BlogCategory','blog_category_id','id');
    }
    public function tags()
    {
    	return $this->belongsToMany('App\Models\blog\Tag');
    }
    public function comments()
    {
    	return $this->hasMany('App\Models\blog\Comment');
    }

}
