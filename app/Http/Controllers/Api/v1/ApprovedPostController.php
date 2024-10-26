<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ApprovedPostCollection;
use App\Http\Resources\v1\ApprovedPostResource;
use App\Models\ApprovedPost;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApprovedPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $approvedPosts = new ApprovedPostCollection((ApprovedPost::all()));

        return response()->json($approvedPosts, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'post_id' => 'required|integer|exists:posts,id',
            'approved_by' => 'required|integer|exists:users,id',
        ]);

        $approvedPost = ApprovedPost::create($validatedData);

        return response()->json($approvedPost, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $approvedPost = ApprovedPost::with(['post', 'user'])
            ->where('post_id', $id)
            ->first();

        if ($approvedPost) {

            $formattedApprovedPost = new ApprovedPostResource($approvedPost);

            return response()->json($formattedApprovedPost, 200);
        } else {
            return response()->json([
                "message" => "Publicación aprobada no encontrada"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        if (ApprovedPost::where('post_id', $id)->exists()) {
            $approvedPost = ApprovedPost::find($id);
            $approvedPost->post_id = is_null($request->post_id) ? $approvedPost->post_id : $request->post_id;
            $approvedPost->approved_by = is_null($request->approved_by) ? $approvedPost->approved_by : $request->approved_by;
            $approvedPost->save();

            return response()->json([
                "message" => "Publicación aprobada actualizada con éxito"
            ], 200);
        } else {
            return response()->json([
                "message" => "Publicación aprobada no encontrada"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        if (ApprovedPost::where('post_id', $id)->exists()) {
            $approvedPost = ApprovedPost::find($id);
            $approvedPost->delete();

            return response()->json([
                "message" => "Publicación aprobada eliminada con éxito"
            ], 202);
        } else {
            return response()->json([
                "message" => "Publicación aprobada no encontrada"
            ], 404);
        }
    }
}
