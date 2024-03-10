<?php

namespace Hannan\ProductReview;

use Hannan\ProductReview\Contracts\ApplicationContract;
use Hannan\ProductReview\Contracts\KernelContract;
use Override;

class Kernel implements KernelContract
{
    public function __construct(public ApplicationContract $app)
    {
        $this->loadRoutes();
    }

    public function loadRoutes()
    {
        include __DIR__ . '/../routes/web.php';
    }

    #[Override] public function handle(Request $request)
    {
        return $this->sendRequestThroughRouter($request);
    }

    protected function sendRequestThroughRouter(Request $request): Response
    {
        $router = $this->app->make('router');
        return $router->dispatch($request);
    }

    #[Override] public function terminate(Request $request, Response $response)
    {
        $response->send();
    }
}