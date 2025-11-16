<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authservice;

    public function __construct(AuthService $authservice){
        $this->authservice = $authservice;


    }
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', 
        ]);
        $result = $this->authservice->register($validated);
       

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $result['user'],
            'token' => $result['token'],
            'token_type' => 'Bearer'
        ], 201);
    }

    /**
     * Login user and create token
     */
    public function login(Request $request)
    {
       $validated =  $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

       $result = $this->authservice->login($validated);

        return response()->json([
            'message' => 'Login successfull',
            'user' => $result['user'],
            'token' => $result['token'],
            'token_type' => 'Bearer'
        ]);
        
    }

    /**
     * Logout user (revoke token)
     */
    public function logout(Request $request)
    {
        $result = $this->authservice->logout();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    /**
     * Get authenticated user info
     */
    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
