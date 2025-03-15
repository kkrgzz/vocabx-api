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
     *  TUTORIAL DOCUMENT: https://www.binaryboxtuts.com/php-tutorials/laravel-11-json-web-tokenjwt-authentication/
     */

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(): JsonResponse
    {
        $validator = Validator::make(request()->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'username' => request()->username,
            'email' => request()->email,
            'password' => bcrypt(request()->password),
        ]);

        // $user = new User;
        // $user->name = request()->name;
        // $user->email = request()->email;
        // $user->password = bcrypt(request()->password);
        // $user->save();

        UserProfile::create([
            'user_id' => $user->id,
            'first_name' => null,
            'last_name' => null,
            'profile_image' => null,
            'mother_language' => null,
            'target_language' => null,
            'api_key' => null,
            'preferred_model_id' => null,
        ]);

        return response()->json($user, 201);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = Auth::user();

        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $user = Auth::user();

        return response()->json([
            'serviceToken' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => $user,
        ]);
    }
}
