<?php

namespace Hannan\ProductReview\Validation;

class Validator
{
    public function fails($data, $rules)
    {
        return !empty($this->validate($data, $rules));
    }

    public function validate($data, $rules)
    {
        $errors = [];
        foreach ($rules as $field => $rule) {
            $rules = explode('|', $rule);
            foreach ($rules as $rule) {
                if ($rule === 'required' && empty($data[$field])) {
                    $errors[$field][] = 'The ' . $field . ' field is required';
                }
                if ($rule === 'email' && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                    $errors[$field][] = 'The ' . $field . ' field must be a valid email address';
                }
                if (str_contains($rule, 'min')) {
                    $min = explode(':', $rule)[1];
                    if (strlen($data[$field]) < $min) {
                        $errors[$field][] = 'The ' . $field . ' field must be at least ' . $min . ' characters';
                    }
                }
                if (str_contains($rule, 'max')) {
                    $max = explode(':', $rule)[1];
                    if (strlen($data[$field]) > $max) {
                        $errors[$field][] = 'The ' . $field . ' field may not be greater than ' . $max . ' characters';
                    }
                }
            }
        }
        return $errors;
    }

    public function passes($data, $rules)
    {
        return empty($this->validate($data, $rules));
    }

    public function errors($data, $rules)
    {
        return $this->validate($data, $rules);
    }

    public function firstError($data, $rules)
    {
        $errors = $this->validate($data, $rules);
        return empty($errors) ? null : $errors[array_key_first($errors)][0];
    }
}