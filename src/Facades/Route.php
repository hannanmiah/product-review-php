<?php

namespace Hannan\ProductReview\Facades;

use Hannan\ProductReview\Application;

class Route
{
    public static function __callStatic($name, $arguments)
    {
        Application::getInstance()->get('router')->$name(...$arguments);
    }
}