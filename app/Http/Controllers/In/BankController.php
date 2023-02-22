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

    public function verifyAccount(Request $request)
    {
        $this->validate($request, [
            "bankCode" => "required|string",
            "accountNumber" => "required|string"
            
        ]);
        
        return response()->json(['message' => 'Here you go.', 'data' => [
            "bankCode"=> $request->bankCode,
            "accountNumber"=> $request->accountNumber,
            "accountName"=>"Damilare Oluwole",
            "bank"=>"Access Bank"
        ]]);
    }
}