<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function logout(Request $request)
    {       
        try {
            $request->user()->tokens()->delete();
            
            return response()->json([
                'message' => 'Successfully logged out'
            ], 201);
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
