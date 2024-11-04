<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PostCollection;
use App\Http\Resources\v1\PostResource;
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
        $posts = new PostCollection((Post::all()));

        return response()->json($posts, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $post = new Post;
        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->place = $request->place;
        $post->start_date_time = $request->start_date_time;
        $post->end_date_time = $request->end_date_time;
        $post->capacity_limit = $request->capacity_limit;
        $post->category_id = $request->category_id;
    
        if ($post->save()) {
            return response()->json([
                'message' => 'Publicación creada con éxito',
                'data' => new PostResource($post)
            ], 201);
        } else {
            return response()->json([
                'message' => 'Error al crear la publicación'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $post = Post::find($id);

        $formattedPost = new PostResource($post);

        if (!empty($formattedPost)) {
            return response()->json($formattedPost, 200);
        } else {
            return response()->json([
                "message" => "Publicación no encontrada"
            ], 404);
        }
    }

    public function approvedPosts(): JsonResponse
    {
        $approvedPosts = Post::where('approved', true)->get();

        return response()->json(new PostCollection($approvedPosts), 200);
    }

    public function notApprovedPosts(): JsonResponse
    {
        $notApprovedPosts = Post::where('approved', false)->get();

        return response()->json(new PostCollection($notApprovedPosts), 200);
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
            $post->place = is_null($request->place) ? $post->place : $request->place;
            $post->description = is_null($request->description) ? $post->description : $request->description;
            $post->start_date_time = is_null($request->start_date_time) ? $post->start_date_time : $request->start_date_time;
            $post->end_date_time = is_null($request->end_date_time) ? $post->end_date_time : $request->end_date_time;
            $post->capacity_limit = is_null($request->capacity_limit) ? $post->capacity_limit : $request->capacity_limit;
            $post->category_id = is_null($request->category_id) ? $post->category_id : $request->category_id;
            $post->post_strike_count = is_null($request->strike_count) ? $post->strike_count : $request->strike_count;
            $post->approved = is_null($request->approved) ? $post->approved : $request->approved;
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

    public function increaseStrikeCount($id){
        if(Post::where('id', $id)->exists()){
            $post = Post::find($id);

            $post->post_strike_count = $post->post_strike_count+1;

            $post->save();

            return response()->json([
                "message" => "Strike incrementado con exito"
            ], 200);
        } else {
            return response()->json([
                "message" => "Publicación no encontrada se incremento sin exito"
            ], 404);
        }
    }

    public function approvePost($id){
        if(Post::where('id', $id)->exists()){
            $post = Post::find($id);

            $post->approved = true;

            $post->save();

            return response()->json([
                "message" => "Publicación aprobado con exito"
            ], 200);
        } else {
            return response()->json([
                "message" => "Publicación no encontrada se incremento sin exito"
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
