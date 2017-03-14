<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
   	// /protected $primaryKey  = 'id';
   	public $incrementing = false;

    public function PageSections()
    {
        return $this->hasMany('App\Models\Page\PageSection','page_id');
    }
}
