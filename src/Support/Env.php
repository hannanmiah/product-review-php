<?php

namespace Hannan\ProductReview\Support;

class Env
{
    public static function get($key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }

    public static function set($key, $value): void
    {
        $_ENV[$key] = $value;
    }
}