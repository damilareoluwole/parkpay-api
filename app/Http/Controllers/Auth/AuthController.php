<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Summary of register
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required|digits:11|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|confirmed|min:6',
            'referral' => 'min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        Wallet::create([
            "user_id" => $user->id,
            "balance" => 275000
        ]);

        return $this->generateToken('Account created successfully', $user);
    }

    /**
     * Summary of login
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user)
            return response()->json([
                'message' => 'Invalid login credentials'
            ], Response::HTTP_UNAUTHORIZED);

        if(!Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Invalid login credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }
        
        return $this->generateToken('Login Successful', $user);
    }

    /**
     * Summary of generateToken
     * @param string $message
     * @param User $user
     * @return JsonResponse
     */
    protected function generateToken(String $message, User $user)
    {
        $token = $user->createToken($user->name);
        $token = $token->plainTextToken;

        return response()->json([
            'message' => 'Account created successfully',
            'data' => [
                'token' => $token,
                'user' => UserResource::make($user)
            ]
        ]);
    }

    /**
     * Summary of logout
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout successfully'
        ]);
    }
}