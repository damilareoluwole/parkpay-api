<?php

namespace App\Http\Controllers\In;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Bank;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

    public function transfer(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|min:100',
            'account_number' => 'required|digits:10',
            'pin' => 'required|digits:4',
            'bank' => 'required'
        ]);

        $user = $request->user();
        
        if(!Hash::check($request->pin, $user->pin)){
            return response()->json([
                'status' => false,
                'message' => 'Invalid Pin'
            ], Response::HTTP_BAD_REQUEST);
        }

        $wallet = $user->wallet;
            
        if($wallet->balance < $request->amount)
            return response()->json(["status" => false,"message" => "Insufficient fund.","data" => []], Response::HTTP_BAD_REQUEST);
        
        $transactions = new Transaction();
        $transactions->type = Transaction::DEBIT;
        $transactions->user_id = $user->id;
        $transactions->wallet_id = $wallet->id;
        $transactions->amount = $request->amount;
        $transactions->account_no = $request->account_number;
        $transactions->account_name = "Damilare Oluwole";
        $transactions->bank_name = "Access Bank";
        $transactions->save();

        $wallet->balance -= $request->amount;
        $wallet->save();

        return response()->json([
            "status" => true,
            "message" => "Successful.",
            "data" => [
                "transaction" => $transactions,
                'user' => UserResource::make($user)
            ]
        ]);
    }
}