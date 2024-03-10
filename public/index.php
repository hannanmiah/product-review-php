<?php

use Hannan\ProductReview\Kernel;
use Hannan\ProductReview\Request;

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';


$kernel = $app->make(Kernel::class);

$router = $app->make('router');

$response = $kernel->handle($request = Request::capture());

$kernel->terminate($request, $response);
