<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt([
            "email" => $request->email,
            "password" => $request->password,
        ])) {
            $user = User::find(auth()->user()->id);

            $success = [
                "message" => "Login successful",
                "access_token" => $user->createToken("authToken")->plainTextToken,
            ];

            return response()->json($success, 200);
        } else {
            return response()->json(["message" => "Login failed"], 401);
        }
    }

    public function register(Request $request): JsonResponse
    {
        if (Auth::guest()) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $success = ["access_token" => $user->createToken("authToken")->plainTextToken,];

            return response()->json($success, 200);
        } else {
            return response()->json(["message" => "User already logged in"], 401);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $request?->user()->currentAccessToken()->delete();

        return response()->json(["message" => "Logout successful"], 200);
    }

    public function currentUser()
    {
        return response()->json(auth()->user(), 200);
    }
}
