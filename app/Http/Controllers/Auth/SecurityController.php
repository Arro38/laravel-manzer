<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SecurityController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Générer un token pour l'utilisateur
        $token = $user->createToken('token-name')->plainTextToken;

        return response(['token' => $token], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $request->user();
            $tokenName = $request->token_name ?? 'default_token_name';
            $token = $user->createToken($tokenName)->plainTextToken;

            return ['token' => $token];
        }
        // Already in api routes don't need to return json
        return response(['message' => 'Invalid credentials'], 401);

        // return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
