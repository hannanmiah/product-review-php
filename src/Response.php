<?php

namespace Hannan\ProductReview;

class Response
{
    public function __construct(public mixed $data = [], public int $code = 200, public array $headers = [])
    {
        $this->setBaseHeaders();
    }

    protected function setBaseHeaders(): void
    {
        if (!isset($this->headers['Content-Type'])) {
            $this->headers['Content-Type'] = 'text/html';
        }
        if (!isset($this->headers['charset'])) {
            $this->headers['charset'] = 'UTF-8';
        }
    }

    public function json(array $data, int $code = 200)
    {
        $this->headers['Content-Type'] = 'application/json';
        $this->data = $data;
        $this->code = $code;
        return $this;
    }

    public function plain(string $data, int $code = 200)
    {
        $this->headers['Content-Type'] = 'text/plain';
        $this->data = $data;
        $this->code = $code;
        return $this;
    }

    public function html()
    {
        $this->headers['Content-Type'] = 'text/html';
        return $this;
    }

    public function send()
    {
        foreach ($this->headers as $key => $value) {
            header("{$key}: {$value}");
        }
        http_response_code($this->code);
        echo json_encode($this->data);
    }
}