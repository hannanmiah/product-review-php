<?php

namespace App\Http\Controllers;

class HomeController
{
    public function index()
    {
        return 'Hello from HomeController Again';
    }

    public function store()
    {
        return ['message' => 'success again'];
    }
}