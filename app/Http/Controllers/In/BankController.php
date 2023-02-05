<?php

namespace App\Http\Controllers\In;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class BankController extends Controller
{
    public function banks(Request $request)
    {
        return response()->json(['message' => 'Here you go.', 'data' => Bank::all()]);
    }
}