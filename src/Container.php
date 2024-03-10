<?php

namespace Hannan\ProductReview;

use Hannan\ProductReview\Contracts\ContainerContract;

class Container implements ContainerContract
{
    #[\Override] public function bind($abstract, $concrete = null, $shared = false)
    {
        // TODO: Implement bind() method.
    }

    #[\Override] public function singleton($abstract, $concrete = null)
    {
        // TODO: Implement singleton() method.
    }

    #[\Override] public function make($abstract, array $parameters = [])
    {
        // TODO: Implement make() method.
    }

    #[\Override] public function instance($abstract, $instance)
    {
        // TODO: Implement instance() method.
    }

    #[\Override] public function get($id)
    {
        // TODO: Implement get() method.
    }

    #[\Override] public function has($id)
    {
        // TODO: Implement has() method.
    }
}