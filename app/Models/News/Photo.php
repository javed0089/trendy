<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function News()
     {
    	return $this->belongsToMany('App\Models\News\News','news_photos');
     }
}
