<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function store(Request $request)
    {
        // Validate user
        $this->validate($request, [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'unique:users,email'],
            'password' => ['required', 'max:255', 'min:6', 'confirmed'],
        ]);

        // Store user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Get token
        $token = $user->createToken('my-token')->plainTextToken;

        // Send response
        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response()->json($response, 201);
    }
}
