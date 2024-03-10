<?php

namespace Hannan\ProductReview;

use Hannan\ProductReview\Contracts\ApplicationContract;

class Application extends Container implements ApplicationContract
{

    #[\Override] public function bind($abstract, $concrete = null, $shared = false)
    {
        // TODO: Implement bind() method.
    }

    #[\Override] public function singleton($abstract, $concrete = null)
    {
        // TODO: Implement singleton() method.
    }

    #[\Override] public function make($abstract, $parameters = [])
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

    #[\Override] public function flush()
    {
        // TODO: Implement flush() method.
    }

    #[\Override] public function offsetExists($key)
    {
        // TODO: Implement offsetExists() method.
    }

    #[\Override] public function offsetGet($key)
    {
        // TODO: Implement offsetGet() method.
    }

    #[\Override] public function offsetSet($key, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    #[\Override] public function offsetUnset($key)
    {
        // TODO: Implement offsetUnset() method.
    }
}