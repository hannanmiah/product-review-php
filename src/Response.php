<?php

namespace Hannan\ProductReview;

class Response
{
    public function __construct(public mixed $data, public int $code = 200, public array $headers = [])
    {
    }

    public function send()
    {
        header('Content-Type: application/json');
        http_response_code($this->code);
        echo json_encode($this->data);
    }
}