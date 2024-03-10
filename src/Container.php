<?php

namespace Hannan\ProductReview;

use Closure;
use Hannan\ProductReview\Contracts\ContainerContract;
use Override;

class Container implements ContainerContract
{
    public array $instances = [];

    public array $aliases = [];
    public array $bindings = [];

    #[Override] public function bind($abstract, $concrete = null, $shared = false)
    {
        $this->bindings[$abstract] = $concrete;
    }

    #[Override] public function singleton($abstract, $concrete = null)
    {
        if ($concrete instanceof Closure) {
            $this->instances[$abstract] = $concrete();
        } else if (is_object($concrete)) {
            $this->instances[$abstract] = $concrete;
        } else {
            $this->instances[$abstract] = new $concrete;
        }
    }

    #[Override] public function make($abstract, array $parameters = [])
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }
        if (isset($this->bindings[$abstract])) {
            return new $this->bindings[$abstract];
        }
        return null;
    }

    #[Override] public function instance($abstract, $instance)
    {
        $this->instances[$abstract] = $instance;
    }

    #[Override] public function get($id)
    {
        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }
        if (isset($this->bindings[$id])) {
            return $this->bindings[$id];
        }
        return null;
    }

    #[Override] public function has($id)
    {
        if (isset($this->instances[$id])) {
            return true;
        }
        if (isset($this->bindings[$id])) {
            return true;
        }
        return false;
    }
}