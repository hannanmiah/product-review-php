<?php

use Hannan\ProductReview\Kernel;
use Hannan\ProductReview\Request;
use Hannan\ProductReview\Response;
use Hannan\ProductReview\Router;

$app = Hannan\ProductReview\Application::getInstance();

$app->bind(Request::class, function () {
    return new Request();
});

$app->bind(Response::class, function () {
    return new Response();
});

$app->singleton('router', fn() => new Router());
$app->singleton(Kernel::class, fn() => new Kernel($app));


return $app;