<?php

namespace Hannan\ProductReview\Facades;

class Artisan extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'artisan';
    }
}