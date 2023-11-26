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
            'tel' => 'required|string|min:10',
            'address' => 'required|string|min:5',
            'sector_id' => 'required|integer|exists:sectors,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tel' => $request->tel,
            'address' => $request->address,
            'sector_id' => $request->sector_id,
        ]);

        // Générer un token pour l'utilisateur
        $token = $user->createToken('token-name')->plainTextToken;

        return response(['token' => $token], 201);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        if($request->has('name')){
            $request->validate([
                'name' => 'required|string',
            ]);
            $user->name = $request->name;
        }
        if($request->has('email')){
            $request->validate([
                'email' => 'required|email|unique:users',
            ]);
            $user->email = $request->email;
        }

        if($request->has('tel')){
            $request->validate([
                'tel' => 'required|string|min:10',
            ]);
            $user->tel = $request->tel;
        }

        if($request->has('address')){
            $request->validate([
                'address' => 'required|string|min:5',
            ]);
            $user->address = $request->address;
        }

        if($request->has('sector_id')){
            $request->validate([
                'sector_id' => 'required|integer|exists:sectors,id',
            ]);
            $user->sector_id = $request->sector_id;
        }

        $user->save();
        return $user;
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
            'new_password_confirmation' => 'required|string|min:8|same:new_password',
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return response(['message' => 'Invalid password'], 401);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        return $user;
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

    public function profile(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request...
        $request->user()->currentAccessToken()->delete();

        return response(['message' => 'Logged out']);
    }
}
