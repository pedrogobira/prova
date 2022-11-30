<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credenciais = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credenciais)) {
            abort(401, 'Credenciais invalidas');
        }

        $token = Auth::user()->createToken('auth_token');

        return response()->json([
            'token' => $token->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json([], 204);
    }
}
