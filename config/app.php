<?php

use Hannan\ProductReview\Support\Env;

return [
    'name' => Env::get('APP_NAME', 'ProductReview'),
    'env' => Env::get('APP_ENV', 'production'),
    'debug' => Env::get('APP_DEBUG', false),
    'url' => Env::get('APP_URL', 'http://localhost'),
    'timezone' => Env::get('APP_TIMEZONE', 'UTC'),
    'locale' => Env::get('APP_LOCALE', 'en'),
    'fallback_locale' => Env::get('APP_FALLBACK_LOCALE', 'en'),
];