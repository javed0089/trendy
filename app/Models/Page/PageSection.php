<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    public function page()
    {
        return $this->belongsTo('App\Models\Page\Page','page_id');
    }
}
