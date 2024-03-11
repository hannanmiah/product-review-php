<?php

namespace Hannan\ProductReview;

class Config
{
    public array $config;

    public function __construct()
    {
        $this->config = $this->load();
    }

    // load the config file
    public static function load()
    {
        return require __DIR__ . '/../config/app.php';
    }

    // get config
    public function get($key)
    {
        return $this->config[$key];
    }

    // put config

    public function put($key, $value)
    {
        $this->config[$key] = $value;
    }


}