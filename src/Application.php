<?php

namespace Hannan\ProductReview;

use Hannan\ProductReview\Contracts\ApplicationContract;
use Override;

class Application extends Container implements ApplicationContract
{
    public static Application $instance;

    public function __construct(public string $basePath = __DIR__)
    {
        $this->boot();
    }

    #[Override] public function boot(): void
    {
        $this->loadConfig();
    }

    private function loadConfig(): void
    {
        $this->instance('config', new Config());
    }

    #[Override] public function instance($abstract, $instance)
    {
        parent::instance($abstract, $instance);
    }

    public static function getInstance(): static
    {
        if (isset(static::$instance)) {
            return static::$instance;
        } else {
            static::$instance = new static();
            return static::$instance;
        }
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

    #[Override] public function get($id)
    {
        return parent::get($id);
    }

    #[Override] public function bind($abstract, $concrete = null, $shared = false)
    {
        parent::bind($abstract, $concrete, $shared);
    }
}