<?php

namespace App\Http\Controllers;

use App\Http\Controller;
use Exception;
use Hannan\ProductReview\Facades\DB;
use Hannan\ProductReview\Request;
use Hannan\ProductReview\Response;

class ReviewController extends Controller
{
    public function index()
    {
        return ['reviews' => [
            ['id' => 1, 'product_id' => 1, 'user_id' => 1, 'message' => 'good'],
            ['id' => 2, 'product_id' => 1, 'user_id' => 2, 'message' => 'bad'],
            ['id' => 3, 'product_id' => 2, 'user_id' => 1, 'message' => 'good'],
            ['id' => 4, 'product_id' => 2, 'user_id' => 2, 'message' => 'bad'],
        ]];
    }

    public function store($request)
    {
        $errors = $this->validate($request, [
            'product_id' => 'required',
            'user_id' => 'required',
            'body' => 'required|min:10|max:255',
        ]);

        if (!empty($errors)) {
            return (new Response())->json(['errors' => $errors], 422);
        }
        try {
            $isInserted = DB::table('reviews')->insert($request->all());
            if (!$isInserted) {
                return (new Response())->json(['message' => 'failed'], 500);
            }
            return (new Response())->json(['message' => 'created', 'data' => $request->all()], 201);
        } catch (Exception $e) {
            return (new Response())->json(['errors' => $errors], 422);
        }
    }

    public function show($id)
    {
        return ['review' => ['id' => $id, 'product_id' => 1, 'user_id' => 1, 'message' => 'good']];
    }

    public function update($id, $request)
    {
        return ['message' => 'update success', 'id' => $id, 'data' => $request->all()];
    }

    public function destroy($id, Request $request)
    {
        return ['message' => 'delete success', 'id' => $id, 'data' => $request->all()];
    }
}