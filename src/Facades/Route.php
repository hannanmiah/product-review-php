<?php

namespace Hannan\ProductReview\Facades;

class Route extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'router';
    }
}