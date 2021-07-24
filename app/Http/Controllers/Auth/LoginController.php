<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function login(Request $request)
    {
        // Validation
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
    
        // If success send response
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json(Auth::user(), 200);
        }
    
        // If fail throw exception
        throw ValidationException::withMessages([
            'email' => 'The provided credentails are incorect.'
        ]);
    }
}
