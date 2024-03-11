<?php

// dd function like laravel
use Hannan\ProductReview\Application;

if (!function_exists('dd')) {
    function dd($data)
    {
        dump($data);
        die();
    }
}

// global app function
if (!function_exists('app')) {
    function app($key = null)
    {
        if ($key) {
            return Application::getInstance()->make($key);
        }
        return Application::getInstance();
    }
}

// get config value
if (!function_exists('config')) {
    function config($key)
    {
        return app('config')->get($key);
    }
}