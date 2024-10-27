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

            return response()->json([
                'token' => $request->user()->createToken($request->username)->plainTextToken,
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

    public function profile(Request $request){
        $personalAccessToken = PersonalAccessToken::findToken($request->token);

        if ($personalAccessToken) {
            $user = $personalAccessToken->tokenable;

            if ($user) {
                return response()->json(new UserResource($user), 200);
            } else {
                return response()->json([
                    'message' => 'Usuario no encontrado',
                ], 404);
            }
        } else {
            return response()->json([
                'message' => 'Token no válido',
            ], 401);
        }
    }
}
