<?php

use Hannan\ProductReview\Application;
use Hannan\ProductReview\Kernel;
use Hannan\ProductReview\Router;

$app = new Application($_ENV['APP_BASE_PATH'] ?? dirname(__DIR__));


$app->singleton('router', fn() => new Router());
$app->singleton(Kernel::class, fn() => new Kernel($app));

return $app;