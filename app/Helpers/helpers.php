<?php

use Illuminate\Support\Facades\App;

if (!function_exists('localized_price')) {
    function localized_price($price)
    {
        $locale = App::getLocale();

        
        if ($locale === 'lv') {
            return number_format($price, 2, ',', ' ');
        }

        
        return number_format($price, 2, '.', ',');
    }
}
