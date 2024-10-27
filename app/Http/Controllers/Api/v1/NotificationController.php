<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\NotificationCollection;
use App\Http\Resources\v1\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $notifications = new NotificationCollection((Notification::all()));

        return response()->json($notifications, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'message' => 'required|string',
            'already_read' => 'boolean',
        ]);

        $notification = Notification::create($validatedData);

        return response()->json(new NotificationResource($notification), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $notification = Notification::find($id);

        $formattedNotification = new NotificationResource($notification);

        if (!empty($formattedNotification)) {
            return response()->json($formattedNotification, 200);
        } else {
            return response()->json([
                "message" => "Notificación no encontrada"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        if (Notification::where('id', $id)->exists()) {
            $notification = Notification::find($id);
            $notification->user_id = is_null($request->user_id) ? $notification->user_id : $request->user_id;
            $notification->message = is_null($request->message) ? $notification->message : $request->message;
            $notification->already_read = is_null($request->already_read) ? $notification->already_read : $request->already_read;
            $notification->save();

            return response()->json([
                "message" => "Notificación actualizada con éxito"
            ], 200);
        } else {
            return response()->json([
                "message" => "Notificación no encontrada"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        if (Notification::where('id', $id)->exists()) {
            $notification = Notification::find($id);
            $notification->delete();

            return response()->json([
                "message" => "Notificación eliminada con éxito"
            ], 202);
        } else {
            return response()->json([
                "message" => "Notificación no encontrada"
            ], 404);
        }
    }
}
