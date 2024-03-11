<?php

namespace Hannan\ProductReview;

use Hannan\ProductReview\Validation\Validator;

class Controller
{
    public Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    public function validate($request, $rules)
    {
        return $this->validator->validate($request, $rules);
    }
}