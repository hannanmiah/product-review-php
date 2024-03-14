<?php

namespace Hannan\ProductReview;

use ArrayAccess;
use Exception;
use Hannan\ProductReview\Contracts\ApplicationContract;
use Override;

class Application extends Container implements ApplicationContract, ArrayAccess
{
    public function __construct(public string $basePath = __DIR__)
    {
        $this->registerBaseBindings();
        $this->boot();
    }

    private function registerBaseBindings(): void
    {
        static::setInstance($this);
        $this->instance('app', $this);
        $this->instance(Application::class, $this);
        $this->instance(Container::class, $this);
    }

    #[Override] public function instance($abstract, $instance)
    {
        parent::instance($abstract, $instance);
    }

    #[Override] public function boot(): void
    {
        $this->loadEnvironment();
        $this->loadConfig();
    }

    private function loadEnvironment(): void
    {
        try {
            $env = new Environment(realpath(__DIR__ . '/../.env'));
            $env->load();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    private function loadConfig(): void
    {
        $this->instance('config', new Config());
    }

    #[Override] public function singleton($abstract, $concrete = null)
    {
        parent::singleton($abstract, $concrete);
    }

    #[Override] public function make($abstract, $parameters = [])
    {
        return parent::make($abstract, $parameters);
    }

    #[Override] public function flush()
    {
        unset($this->instances);
        unset($this->aliases);
        unset($this->bindings);
    }

    #[Override] public function has($id)
    {
        return parent::has($id);
    }

    #[Override] public function bind($abstract, $concrete = null, $shared = false)
    {
        parent::bind($abstract, $concrete, $shared);
    }

    #[Override] public function offsetExists(mixed $offset): bool
    {
        return isset($this->instances[$offset]) || isset($this->bindings[$offset]);
    }

    #[Override] public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }

    #[Override] public function get($id)
    {
        return parent::get($id);
    }

    #[Override] public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->instance($offset, $value);
    }

    #[Override] public function offsetUnset(mixed $offset): void
    {
        unset($this->instances[$offset]);
        unset($this->bindings[$offset]);
    }
}