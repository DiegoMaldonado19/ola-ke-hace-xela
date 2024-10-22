<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource in a formatted DTO.
     */
    public function index(): JsonResponse
    {
        $reports = Report::with(['user', 'post'])->get();

        $formattedReports = $reports->map(function ($report) {
            return [
                'id' => $report->id,
                'username' => $report->user->username,
                'reported_post' => $report->post->title,
                'comment' => $report->comment,
            ];
        });

        return response()->json($formattedReports, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'post_id' => 'required|integer|exists:posts,id',
            'user_id' => 'required|integer|exists:users,id',
            'comment' => 'required|string',
        ]);

        $report = Report::create($validatedData);

        return response()->json($report, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $report = Report::find($id);

        if (!empty($report)) {
            return response()->json($report, 200);
        } else {
            return response()->json([
                "message" => "Reporte no encontrado"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        if (Report::where('id', $id)->exists()) {
            $report = Report::find($id);
            $report->post_id = is_null($request->post_id) ? $report->post_id : $request->post_id;
            $report->user_id = is_null($request->user_id) ? $report->user_id : $request->user_id;
            $report->comment = is_null($request->comment) ? $report->comment : $request->comment;
            $report->save();

            return response()->json([
                "message" => "Reporte actualizado con éxito"
            ], 200);
        } else {
            return response()->json([
                "message" => "Reporte no encontrado"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        if (Report::where('id', $id)->exists()) {
            $report = Report::find($id);
            $report->delete();

            return response()->json([
                "message" => "Reporte eliminado con éxito"
            ], 202);
        } else {
            return response()->json([
                "message" => "Reporte no encontrado"
            ], 404);
        }
    }
}
