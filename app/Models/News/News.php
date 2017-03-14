<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function Photos()
    {
        return $this->belongsToMany('App\Models\News\Photo','news_photos');
    }
}
