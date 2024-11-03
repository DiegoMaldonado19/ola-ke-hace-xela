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
        $notification = new Notification;
        $notification->user_id = $request->user_id;
        $notification->message = $request->message;
        $notification->already_read = $request->already_read;
    
        if ($notification->save()) {
            return response()->json([
                'message' => 'Notificación creada con éxito',
                'data' => new NotificationResource($notification)
            ], 201);
        } else {
            return response()->json([
                'message' => 'Error al crear la notificación'
            ], 500);
        }
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
     * Get notifications by user ID
     */
    public function getNotificationsByUserId($userId): JsonResponse
    {
        $notifications = Notification::where('user_id', $userId)->get();

        if ($notifications->isEmpty()) {
            return response()->json([
                "message" => "No se encontraron notificaciones para el usuario con ID $userId"
            ], 404);
        }

        return response()->json(new NotificationCollection(($notifications), 200));
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
     * Mark all notifications not read, as read
     */
    public function markAllAsRead($userId): JsonResponse
    {
        
        $notifications = Notification::where('user_id', $userId)
                                    ->where('already_read', false)
                                    ->get();

        if ($notifications->isEmpty()) {
            return response()->json([
                "message" => "No se encontraron notificaciones no leídas para el usuario con ID $userId"
            ], 404);
        }

        Notification::where('user_id', $userId)
                    ->where('already_read', false)
                    ->update(['already_read' => true]);

        return response()->json([
            "message" => "Todas las notificaciones no leídas han sido marcadas como leídas"
        ], 200);
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
