<?php

namespace Hannan\ProductReview\Facades;

class Facade
{
    public static function __callStatic($name, $arguments)
    {
        $instance = static::resolveFacadeInstance(static::getFacadeAccessor());

        return $instance->$name(...$arguments);
    }

    protected static function resolveFacadeInstance($name)
    {
        return app()->get($name);
    }

    protected static function getFacadeAccessor(): string
    {
        return '';
    }
}