<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function Products()
    {
    	return $this->hasMany('App\Models\Product\Product');
    }

    public function Parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function Children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
