<?php

namespace App\Http\Controllers\In;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Summary of profile
     * @param Request $request
     * @return JsonResponse
     */
    public function profile(Request $request)
    {
        return response()->json([
            "message" => "Here you go.", 
            "data" => UserResource::make($request->user())
        ]);
    }
}