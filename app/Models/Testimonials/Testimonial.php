<?php

namespace App\Models\Testimonials;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Testimonial extends Model
{
    //


     public function TextTrans($text)
    {
        App::setLocale('ar');
        $locale=App::getLocale();
        $column=$text.'_'.$locale;
        //echo ($column);
        return $column;
    }
}
