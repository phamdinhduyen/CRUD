<?php

if (!function_exists('base_path')) {
    function base_path($uri) {
        return 'http://localhost/test/'.$uri;
    }
}