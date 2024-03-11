<?php

namespace Hannan\ProductReview\Exceptions\Routing;

use Exception;

class InvalidActionException extends Exception
{
    public function __construct($message = "Invalid action")
    {
        parent::__construct($message);
    }
}