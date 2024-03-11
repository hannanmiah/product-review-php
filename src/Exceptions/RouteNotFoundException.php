<?php

namespace Hannan\ProductReview\Exceptions;

use Exception;

class RouteNotFoundException extends Exception
{
    public function __construct($message = "Route not found")
    {
        parent::__construct($message);
    }
}