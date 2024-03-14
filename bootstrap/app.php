<?php

use Hannan\ProductReview\Application;
use Hannan\ProductReview\Database\Database;
use Hannan\ProductReview\Kernel;
use Hannan\ProductReview\Router;

$app = new Application($_ENV['APP_BASE_PATH'] ?? dirname(__DIR__));


$app->singleton('router', fn() => new Router());
$app->singleton(Kernel::class, fn() => new Kernel($app));
$app->singleton('db', fn() => new Database(
    config('database.mysql.host'),
    config('database.mysql.database'),
    config('database.mysql.username'),
    config('database.mysql.password')
));

return $app;