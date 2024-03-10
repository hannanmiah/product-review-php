<?php

namespace Hannan\ProductReview\Contracts;

use Hannan\ProductReview\Request;
use Hannan\ProductReview\Response;

interface KernelContract
{
    public function handle(Request $request);

    public function terminate(Request $request, Response $response);

}