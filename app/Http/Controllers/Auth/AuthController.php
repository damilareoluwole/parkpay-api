<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
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
            'referral_code' => 'min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password)
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
                'message' => 'Invalid login or password'
            ], Response::HTTP_UNAUTHORIZED);

        if(!Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Invalid login or password'
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
}