<?php

// dd function like laravel
use Hannan\ProductReview\Container;

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
            return Container::getInstance()->make($key);
        }
        return Container::getInstance();
    }
}

// get config value
if (!function_exists('config')) {
    function config($key)
    {
        return app('config')->get($key);
    }
}

// env function
if (!function_exists('env')) {
    function env($key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }
}