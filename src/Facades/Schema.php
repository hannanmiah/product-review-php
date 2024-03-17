<?php

namespace Hannan\ProductReview\Facades;

class Schema extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'schema';
    }
}