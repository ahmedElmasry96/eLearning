<?php

use App\Models\Setting;

if(!function_exists('getWebsiteInfo')) {
    function getWebsiteInfo()
    {
        $data = Setting::first();
        return $data;
    }
}