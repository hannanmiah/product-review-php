<?php

namespace Hannan\ProductReview\Facades;

class Route
{
    public static function __callStatic($name, $arguments)
    {
        app()->get('router')->$name(...$arguments);
    }
}