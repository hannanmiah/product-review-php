<?php

use App\Http\Kernel;
use Hannan\ProductReview\Application;
use Hannan\ProductReview\Console\Kernel as ConsoleKernel;

$app = new Application($_ENV['APP_BASE_PATH'] ?? dirname(__DIR__));


$app->singleton(Kernel::class, fn() => new Kernel($app));
$app->singleton(ConsoleKernel::class, fn() => new ConsoleKernel($app));


return $app;