<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Jobs\SendRegistrationEmailJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        SendRegistrationEmailJob::dispatch($user)->delay(now()->addMinutes(5));

        return response()->json(['message' => 'User registered successfully'], Response::HTTP_CREATED);
    }
}