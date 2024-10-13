<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $attendances = Attendance::all();
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
    public function show($id): JsonResponse
    {
        $attendance = Attendance::find($id);

        if (!empty($attendance)) {
            return response()->json($attendance, 200);
        } else {
            return response()->json([
                "message" => "Asistencia no encontrada"
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
