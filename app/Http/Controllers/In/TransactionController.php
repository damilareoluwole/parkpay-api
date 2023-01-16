<?php

namespace App\Http\Controllers\In;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    /**
     * Summary of profile
     * @param Request $request
     * @return JsonResponse
     */
    public function transactions(Request $request)
    {
        return response()->json([
            "message" => "Here you go.",
            "data" => $request->user()->transactions
        ]);
    }
}