<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
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
        $user_roles = UserRole::all();
        return response()->json($user_roles, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $userRole = UserRole::create($validatedData);

        return response()->json($userRole, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $user = UserRole::find($id);

        if(!empty($user)){
            return response()->json([
                $user
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
