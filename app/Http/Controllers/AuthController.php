<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Register a User
     */
    public function register(): JsonResponse
    {
        $validator = Validator::make(request()->all(), [
            'username' => 'required|min:3|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8|max:30',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 'auth.register.validation_failed',
                'message' => 'Registration validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::create([
                'username' => request()->username,
                'email' => request()->email,
                'password' => bcrypt(request()->password),
            ]);

            UserProfile::create(['user_id' => $user->id]);

            $token = Auth::attempt(request(['email', 'password']));

            return $this->respondWithToken($token);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 'auth.register.failed',
                'message' => 'Account creation failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * User Login
     */
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json([
                'code' => 'auth.login.invalid_credentials',
                'message' => 'Invalid email or password'
            ], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get Authenticated User
     */
    public function me(): JsonResponse
    {
        try {
            $user = Auth::user()->load('profile');
            return response()->json(['user' => $user]);
            
        } catch (\Exception $e) {
            return response()->json([
                'code' => 'auth.session.invalid',
                'message' => 'Invalid or expired session'
            ], 401);
        }
    }

    /**
     * Logout User
     */
    public function logout(): JsonResponse
    {
        try {
            Auth::logout();
            return response()->json([
                'code' => 'auth.logout.success',
                'message' => 'Successfully logged out'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'code' => 'auth.logout.failed',
                'message' => 'Logout failed'
            ], 500);
        }
    }

    /**
     * Refresh Token
     */
    public function refresh(): JsonResponse
    {
        try {
            return $this->respondWithToken(Auth::refresh());
            
        } catch (\Exception $e) {
            return response()->json([
                'code' => 'auth.token.refresh_failed',
                'message' => 'Token refresh failed'
            ], 401);
        }
    }

    /**
     * Standardized Token Response
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'code' => 'auth.token.generated',
            'serviceToken' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => Auth::user()->load('profile')
        ]);
    }
}