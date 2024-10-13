<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $posts = Post::all();
        return response()->json($posts, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'place' => 'required|string',
            'start_date_time' => 'required|date',
            'end_date_time' => 'required|date',
            'capacity_limit' => 'required|integer',
            'category_id' => 'required|integer|exists:post_categories,id',
            'strike_count' => 'integer',
            'approved' => 'boolean',
            'automatically_post' => 'boolean',
        ]);

        $post = Post::create($validatedData);

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $post = Post::find($id);

        if (!empty($post)) {
            return response()->json($post, 200);
        } else {
            return response()->json([
                "message" => "Publicación no encontrada"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        if (Post::where('id', $id)->exists()) {
            $post = Post::find($id);
            $post->user_id = is_null($request->user_id) ? $post->user_id : $request->user_id;
            $post->title = is_null($request->title) ? $post->title : $request->title;
            $post->description = is_null($request->description) ? $post->description : $request->description;
            $post->place = is_null($request->place) ? $post->place : $request->place;
            $post->start_date_time = is_null($request->start_date_time) ? $post->start_date_time : $request->start_date_time;
            $post->end_date_time = is_null($request->end_date_time) ? $post->end_date_time : $request->end_date_time;
            $post->capacity_limit = is_null($request->capacity_limit) ? $post->capacity_limit : $request->capacity_limit;
            $post->category_id = is_null($request->category_id) ? $post->category_id : $request->category_id;
            $post->strike_count = is_null($request->strike_count) ? $post->strike_count : $request->strike_count;
            $post->approved = is_null($request->approved) ? $post->approved : $request->approved;
            $post->automatically_post = is_null($request->automatically_post) ? $post->automatically_post : $request->automatically_post;
            $post->save();

            return response()->json([
                "message" => "Publicación actualizada con éxito"
            ], 200);
        } else {
            return response()->json([
                "message" => "Publicación no encontrada"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        if (Post::where('id', $id)->exists()) {
            $post = Post::find($id);
            $post->delete();

            return response()->json([
                "message" => "Publicación eliminada con éxito"
            ], 202);
        } else {
            return response()->json([
                "message" => "Publicación no encontrada"
            ], 404);
        }
    }
}
