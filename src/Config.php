<?php

namespace Hannan\ProductReview;

use ArrayAccess;
use Hannan\ProductReview\Support\Arr;
use Override;

class Config implements ArrayAccess
{
    protected array $config;

    public function __construct()
    {
        $this->config = $this->load();
    }

    // load the config file
    protected function load()
    {
        $config = [];
        foreach ($this->scanDir() as $file) {
            $key = str_replace('.php', '', $file);
            $config[$key] = require __DIR__ . "/../config/$file";
        }
        return $config;
    }

    // scan all files in config directory and return the array of files

    private function scanDir(): array
    {
        $files = scandir(__DIR__ . '/../config', SCANDIR_SORT_DESCENDING);
        return array_filter($files, fn($file) => str_contains($file, '.php'));
    }

    // get config using dont notation syntax

    public function get($key)
    {
        return Arr::get($this->all(), $key);
    }

    public function all(): array
    {
        return $this->config;
    }

    public function put($key, $value)
    {
        $this->config[$key] = $value;
    }

    #[Override] public function offsetExists(mixed $offset): bool
    {
        return isset($this->config[$offset]);
    }

    #[Override] public function offsetGet(mixed $offset): mixed
    {
        return $this->config[$offset];
    }

    #[Override] public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->config[$offset] = $value;
    }

    #[Override] public function offsetUnset(mixed $offset): void
    {
        unset($this->config[$offset]);
    }
}