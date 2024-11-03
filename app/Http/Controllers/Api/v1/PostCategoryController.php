<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PostCategoryCollection;
use App\Http\Resources\v1\PostCategoryResource;
use App\Models\PostCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $postCategories = new PostCategoryCollection((PostCategory::all()));
        return response()->json($postCategories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
       
        $postCategory = new PostCategory;

        $postCategory->name = $request->name;

        if ($post->save()) {
            return response()->json([
                'message' => 'Publicación creada con éxito',
                'data' => new PostCategoryResource($postCategory)
            ], 201);
        } else {
            return response()->json([
                'message' => 'Error al crear la categoria'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $postCategory = PostCategory::find($id);

        $formattedPostCategory = new PostCategoryResource($postCategory);

        if (!empty($formattedPostCategory)) {
            return response()->json($formattedPostCategory, 200);
        } else {
            return response()->json([
                "message" => "Categoría no encontrada"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        if (PostCategory::where('id', $id)->exists()) {
            $postCategory = PostCategory::find($id);
            $postCategory->name = is_null($request->name) ? $postCategory->name : $request->name;
            $postCategory->save();

            return response()->json([
                "message" => "Categoría actualizada con éxito"
            ], 200);
        } else {
            return response()->json([
                "message" => "Categoría no encontrada"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        if (PostCategory::where('id', $id)->exists()) {
            $postCategory = PostCategory::find($id);
            $postCategory->delete();

            return response()->json([
                "message" => "Categoría eliminada con éxito"
            ], 202);
        } else {
            return response()->json([
                "message" => "Categoría no encontrada"
            ], 404);
        }
    }
}
