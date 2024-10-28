<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'auth_token' => 'required',
    ]);

    // Recherche de l'utilisateur avec l'email fourni
    $user = User::where('email', $request->email)->first();

    // Vérification de l'utilisateur
    if (!$user) {
        return response()->json(["message" => "User not found"], 404);
    }

    // Vérification du mot de passe
    if (!Hash::check($request->password, $user->password)) {
        return response()->json(["message" => "Incorrect password"], 401);
    }

    // Vérification de l'auth_token
    if ($user->auth_token !== $request->auth_token) {
        return response()->json(["message" => "Invalid auth token"], 401);
    }

    // Authentification réussie
    Auth::login($user);

    $success = [
        "message" => "Login successful",
        "access_token" => $user->createToken("authToken")->plainTextToken,
    ];

    return response()->json($success, 200);
}


    public function register(RegisterRequest $request): JsonResponse
    {
        if (Auth::guest()) {
            // Vérifiez si l'email existe déjà
            $existingUser = User::where('email', $request->email)->first();

            if ($existingUser) {
                return response()->json(["message" => "Cet email est déjà utilisé"], 409);
            }

            $authToken = Str::random(20);


            // return response()->json(["nex" => $authToken], 200);

            $user = new User();

            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->auth_token = $authToken;

            $user->save();

            // Envoi du mail de notification à l'admin
            Mail::send('emails.adminNotification', [
                'name' => $user->name,
                'email' => $user->email,
                'auth_token' => $authToken,
            ], function ($message) {
                $message->to('scoress.agbalo@epitech.eu');
                $message->subject('Nouvelle inscription d’utilisateur');
            });

            // Envoyer un email de bienvenue à l’utilisateur
            Mail::send('emails.userWelcome', [
                'name' => $user->name,
                'email' => $user->email,
            ], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Bienvenue sur notre plateforme');
            });

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
