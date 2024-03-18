<?php

use App\Http\Kernel;
use Hannan\ProductReview\Request;

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle($request = Request::capture());

$kernel->terminate($request, $response);

