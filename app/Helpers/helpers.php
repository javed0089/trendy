<?php

if (! function_exists('lang_col')) {
    /**
     * Generate something
     *
     * @param  string  $text
     * @return string
     */
    function lang_col($column)
    {   
        return $column.'_'.LaravelLocalization::getCurrentLocale();
    }
}