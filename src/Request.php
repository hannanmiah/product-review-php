<?php

namespace Hannan\ProductReview;

use ArrayAccess;
use Override;

class Request implements ArrayAccess
{
    public string $uri;
    public string $method;

    public array $data = [];

    public array $headers = [];

    public function __construct()
    {
        $this->uri = $this->uri();
        $this->method = $this->method();
        $this->data = $this->extractData();
        $this->headers = getallheaders();
    }

    public function uri()
    {
        return trim($_SERVER['REQUEST_URI'], '/');
    }

    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    private function extractData(): array
    {
        if ($this->isExpectingJson()) {
            return (array)json_decode(file_get_contents('php://input'), true);
        }
        return $_REQUEST;
    }

    private function isExpectingJson(): bool
    {
        return isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json';
    }

    public static function capture(): static
    {
        return new static();
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function __unset($name)
    {
        unset($this->data[$name]);
    }

    public function all(): array
    {
        return $this->data;
    }

    #[Override] public function offsetExists(mixed $offset): bool
    {
        // check offset exist or not
        return isset($this->data[$offset]);
    }

    #[Override] public function offsetGet(mixed $offset): mixed
    {
        // get value from offset
        return $this->data[$offset];
    }

    #[Override] public function offsetSet(mixed $offset, mixed $value): void
    {
        // set value to offset
        $this->data[$offset] = $value;
    }

    #[Override] public function offsetUnset(mixed $offset): void
    {
        // unset value from offset
        unset($this->data[$offset]);
    }
}