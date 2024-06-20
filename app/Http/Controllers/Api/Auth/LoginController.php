<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password'  => 'required|min:8'
        ]);

        if(Auth::attempt($credentials))
        {
            return response()->json([
                'message' => 'Login Success',
                'token' => Auth::user()->createToken('auth_token')->plainTextToken
            ]);
        }

        return response()->json([
            'error' => 'Your Credentials Not Match'
        ]);
    }
}
