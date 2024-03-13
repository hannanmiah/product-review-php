<?php

namespace Hannan\ProductReview\Support;

class Arr
{
    // flatten array to single level with dot level nesting
    public static function dot($array): array
    {
        $results = [];
        $resultKey = '';
        foreach ($array as $key => $value) {
            $resultKey = $resultKey ? $resultKey . '.' . $key : $key;
            if (is_array($value) && !empty($value)) {
                $results = array_merge($results, self::dot($value));
            } else {
                $results[$resultKey] = $value;
            }
        }
        return $results;
    }

    // get value from array by key with dot level nesting
    public static function get($array, $key, $default = null)
    {
        if (is_null($key)) {
            return $array;
        }
        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return $default;
            }
            $array = $array[$segment];
        }
        return $array;
    }

}