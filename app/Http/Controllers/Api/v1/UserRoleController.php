<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\UserResource;
use App\Http\Resources\v1\UserRoleCollection;
use App\Models\UserRole;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $user_roles = new UserRoleCollection((UserRole::all()));
        return response()->json($user_roles, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $userRole = new UserRole;
        $userRole->name = $request->name;
    
        if ($userRole->save()) {
            return response()->json([
                'message' => 'Rol de usuario creado con éxito',
                'data' => new UserResource($userRole)
            ], 201);
        } else {
            return response()->json([
                'message' => 'Error al crear el rol de usuario'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $userRole = UserRole::find($id);

        $formattedUserRole = new UserResource($userRole);

        if(!empty($formattedUserRole)){
            return response()->json([
                $formattedUserRole
            ], 200);
        } else {
            return response()->json([
                "message" => "Usuario no encontrado"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        if( UserRole::where('id', $id)->exists()){
            $user_role = UserRole::find($id);
            $user_role->name = is_null($request->name) ? $user_role->name : $request->name;
            $user_role->save();
            return response()->json([
                "message" => "Rol actualizado con exito"
            ], 200);
        } else {
            return response()->json([
                "message" => "Rol no encontrado"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        if(UserRole::where('id', $id)->exists()){
            $user_role = UserRole::find($id);
            $user_role->delete();

            return response()->json([
                "message" => "Rol eliminado con exito"
            ], 202);
        } else {
            return response()->json([
                "message" => "Rol no encontrado"
            ], 404);
        }
    }
}
