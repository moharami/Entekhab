<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('mobile', 'password');


        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], Response::HTTP_OK);


    }
}