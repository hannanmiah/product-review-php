<?php

namespace Hannan\ProductReview\Console;

interface KernelContract
{
    public function handle(Input $input, Output $output): int;

    public function terminate(Input $input, int $status): void;
}