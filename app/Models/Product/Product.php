<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function Category()
    {
    	return $this->belongsTo('App\Models\Product\Category','category_id','id');
    }
    public function Brand()
    {
    	return $this->belongsTo('App\Models\Product\Brand','brand_id');
    }
    public function Files()
    {
    	return $this->belongsToMany('App\Models\Product\File','product_file');
    }
    public function Images()
    {
        return $this->belongsToMany('App\Models\Product\Image','product_images');
    }
    
    

}
