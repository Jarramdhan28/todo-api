<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
         $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:8'
        ]);

        $register = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $register->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $register,
            'token' => $token
        ]);
    }
}
