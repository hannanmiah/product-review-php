<?php

namespace App\Http\Controllers;

class ReviewController
{
    public function index()
    {
        return 'Hello from ReviewController';
    }

    public function store()
    {
        return ['message' => 'success'];
    }

    public function show($id)
    {
        return ['id' => $id];
    }

    public function update($id)
    {
        return ['message' => 'success'];
    }

    public function destroy($id)
    {
        return ['message' => 'success'];
    }
}