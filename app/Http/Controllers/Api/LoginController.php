<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\v1\UserResource;

class LoginController extends Controller
{
    public function login(Request $request){
        $this->validateLogin($request);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user(); // Obtener el usuario autenticado

            return response()->json([
                'user' => new UserResource($user),
                'token' => $user->createToken($request->username)->plainTextToken,
                'message' => 'Success'
            ], 200);
        }

        return response()->json([
            'message' => "Unauthorized"
        ], 401);
    }

    public function validateLogin(Request $request){
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'username' => 'required'
        ]);
    }

}
