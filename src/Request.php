<?php

namespace Hannan\ProductReview;

class Request
{
    public string $uri;
    public string $method;

    public array $data = [];

    public array $headers = [];

    public function __construct()
    {
        $this->uri = $this->uri();
        $this->method = $this->method();
        $this->data = $_REQUEST;
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

    public static function capture()
    {
        return new static();
    }
}