<?php

namespace Hannan\ProductReview;

use ArrayAccess;
use Exception;
use Hannan\ProductReview\Console\Artisan;
use Hannan\ProductReview\Contracts\ApplicationContract;
use Hannan\ProductReview\Database\Database;
use Hannan\ProductReview\Database\Schema;
use Override;

class Application extends Container implements ApplicationContract, ArrayAccess
{
    public function __construct(public string $basePath = __DIR__)
    {
        $this->boot();
        $this->registerBaseBindings();
        $this->registerAliases();

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

    #[Override] public function instance($abstract, $instance)
    {
        parent::instance($abstract, $instance);
    }

    private function registerBaseBindings(): void
    {
        static::setInstance($this);
        $this->instance('app', $this);
        $this->instance(Application::class, $this);
        $this->instance(Container::class, $this);
    }

    private function registerAliases(): void
    {
        $this->singleton('router', fn() => new Router());
        $this->singleton('db', fn() => new Database(
            config('database.mysql.host'),
            config('database.mysql.database'),
            config('database.mysql.username'),
            config('database.mysql.password')
        ));

        $this->singleton('schema', fn() => new Schema($this->get('db')));
        $this->instance('artisan', new Artisan());
    }

    #[Override] public function singleton($abstract, $concrete = null): void
    {
        parent::singleton($abstract, $concrete);
    }

    #[Override] public function get($id)
    {
        return parent::get($id);
    }

    public function basePath(string $path = ''): string
    {
        return $this->basePath . ($path ? DIRECTORY_SEPARATOR . $path : $path);
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