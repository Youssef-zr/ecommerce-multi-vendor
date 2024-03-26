<?php

use Illuminate\Support\Facades\File;

/**
 * side bar active links
 */

if (!function_exists('setActive')) {
    function setActive(array $route)
    {
        if (is_array($route)) {
            foreach ($route as $r) {
                if (request()->routeIs($r)) {
                    return 'active';
                }
            }
        }
    }
}

// make new directory to storage
if(!function_exists('makeDir')){
    function makeDir($path){
        if (!File::exists($path)) {
            File::makeDirectory($path);
        }
    }
}

// remove directory from storage
if(!function_exists('removeDir')){
    function removeDir($path){

        if (File::exists($path) and File::isDirectory($path) and empty(File::files($path))) {
            File::deleteDirectory($path);
        }
    }
}
