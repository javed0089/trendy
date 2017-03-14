<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
     public function Products()
     {
    	return $this->belongsToMany('App\Models\Product\Product','product_images');
     }
}
