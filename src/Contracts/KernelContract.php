<?php

namespace Hannan\ProductReview\Contracts;

interface KernelContract
{
    public function handle();

    public function terminate();

}