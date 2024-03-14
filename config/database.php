<?php

use Hannan\ProductReview\Support\Env;

return [
    'mysql' => [
        'name' => Env::get('DB_NAME', 'product_review'),
        'username' => Env::get('DB_USERNAME', 'root'),
        'password' => Env::get('DB_PASSWORD', ''),
        'connection' => Env::get('DB_CONNECTION', 'mysql'),
        'host' => Env::get('DB_HOST', 'localhost'),
    ]
];