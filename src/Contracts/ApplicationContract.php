<?php

namespace Hannan\ProductReview\Contracts;

interface ApplicationContract
{
    public function bind($abstract, $concrete = null, $shared = false);

    public function singleton($abstract, $concrete = null);

    public function make($abstract, $parameters = []);

    public function instance($abstract, $instance);

    public function get($id);

    public function has($id);

    public function flush();
}