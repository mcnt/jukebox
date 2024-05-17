<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) {
        User::create($request->validated());

        return ['success' => 'user.created'];
    }

    public function login(LoginRequest $request) {
        if (Auth::attempt($request->validated())) {
            return ['success' => 'login.authorized', 'token' => $request->user()->createToken('')->plainTextToken];
        }

        return response(['error' => 'login.unauthorized'], 402);
    }
}
