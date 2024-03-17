<?php

namespace Hannan\ProductReview\Facades;

class DB extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'db';
    }
}