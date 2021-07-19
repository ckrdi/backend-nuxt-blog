<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function login(Request $request)
    {
        try {
            // Validate user
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required']
            ]);

            // Check email
            $user = User::where('email', $credentials['email'])->first();

            // Check password
            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                
                // If fails, send response
                return response()->json([
                    'message' => 'The provided credentials do not match our records.'
                ], 401);
            }

            // If succeed, get token
            $token = $user->createToken('my-token')->plainTextToken;

            // Send response
            $response = [
                'user' => $user,
                'token' => $token,
            ];

            return response()->json($response, 201);
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
