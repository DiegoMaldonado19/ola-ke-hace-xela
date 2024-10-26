<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\AttendanceCollection;
use App\Http\Resources\v1\AttendanceResource;
use App\Models\Attendance;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $attendances = new AttendanceCollection((Attendance::all()));

        return response()->json($attendances, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'post_id' => 'required|integer|exists:posts,id',
        ]);

        $attendance = Attendance::create($validatedData);

        return response()->json($attendance, 201);
    }

    /**
     * Display the specified resource.
     */
    public function getAttendancesByUsername($username): JsonResponse
    {
        $user = User::where('username', $username)->first();

        if ($user) {

            $attendance = Attendance::with(['user', 'post'])
                ->where('user_id', $user->id)
                ->get();

            $formattedAttendance = new AttendanceCollection($attendance);

            return response()->json($formattedAttendance, 200);
        } else {
            return response()->json([
                "message" => "Usuario no encontrado"
            ], 404);
        }
    }

    public function getAttendancesByPost($postId): JsonResponse
    {
        $post = Post::find($postId);

        if ($post) {

            $attendance = Attendance::with(['user', 'post'])
                ->where('post_id', $post->id)
                ->get();

            $formattedAttendance = new AttendanceCollection($attendance);

            return response()->json($formattedAttendance, 200);
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
        if (Attendance::where('user_id', $id)->exists()) {
            $attendance = Attendance::find($id);
            $attendance->user_id = is_null($request->user_id) ? $attendance->user_id : $request->user_id;
            $attendance->post_id = is_null($request->post_id) ? $attendance->post_id : $request->post_id;
            $attendance->save();

            return response()->json([
                "message" => "Asistencia actualizada con éxito"
            ], 200);
        } else {
            return response()->json([
                "message" => "Asistencia no encontrada"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        if (Attendance::where('user_id', $id)->exists()) {
            $attendance = Attendance::find($id);
            $attendance->delete();

            return response()->json([
                "message" => "Asistencia eliminada con éxito"
            ], 202);
        } else {
            return response()->json([
                "message" => "Asistencia no encontrada"
            ], 404);
        }
    }
}
