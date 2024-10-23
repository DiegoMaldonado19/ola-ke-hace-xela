<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:50|unique:users',
            'password' => 'required|string|max:255',
            'role_id' => 'required|integer|exists:user_roles,id',
            'email' => 'required|string|max:100|unique:users',
            'cui' => 'required|string|max:13|unique:users',
            'name' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'phone' => 'required|string|max:15',
        ]);

        $user = User::create($validatedData);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $user = User::find($id);

        if (!empty($user)) {
            return response()->json($user, 200);
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
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->username = is_null($request->username) ? $user->username : $request->username;
            $user->password = is_null($request->password) ? $user->password : $request->password;
            $user->role_id = is_null($request->role_id) ? $user->role_id : $request->role_id;
            $user->email = is_null($request->email) ? $user->email : $request->email;
            $user->cui = is_null($request->cui) ? $user->cui : $request->cui;
            $user->name = is_null($request->name) ? $user->name : $request->name;
            $user->lastname = is_null($request->lastname) ? $user->lastname : $request->lastname;
            $user->phone = is_null($request->phone) ? $user->phone : $request->phone;
            $user->automatically_post = is_null($request->automatically_post) ? $user->automatically_post : $request->automatically_post;
            $user->save();

            return response()->json([
                "message" => "Usuario actualizado con éxito"
            ], 200);
        } else {
            return response()->json([
                "message" => "Usuario no encontrado"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->delete();

            return response()->json([
                "message" => "Usuario eliminado con éxito"
            ], 202);
        } else {
            return response()->json([
                "message" => "Usuario no encontrado"
            ], 404);
        }
    }
}
