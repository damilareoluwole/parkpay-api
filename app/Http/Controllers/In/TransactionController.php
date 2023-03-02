<?php

namespace App\Http\Controllers\In;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Transaction;
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

    /**
     * Summary of receivePayment
     * @param Request $request
     * @return JsonResponse
     */
    public function receivePayment(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);

        return response()->json([
            "message" => "Here you go.",
            "data" => [
                "amount" => $request->amount,
                "description" => $request->description ?? null,
                "bank" => "Zulu Bank",
                "account_number" => "01238746744",
                "account_name" => "Swwipe Checkout"
            ]
        ]);
    }

    /**
     * Summary of creditTransaction
     * @param Request $request
     * @return JsonResponse
     */
    public function creditTransaction(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
            'sender_account_number' => 'required|digits:10',
            'sender_account_name' => 'required',
            'sender_bank_name' => 'required'
        ]);

        $user = $request->user();
        $wallet = $user->wallet;
        
        $transactions = new Transaction();
        $transactions->type = Transaction::CREDIT;
        $transactions->user_id = $user->id;
        $transactions->wallet_id = $wallet->id;
        $transactions->amount = $request->amount;
        $transactions->account_no = $request->sender_account_number;
        $transactions->account_name = $request->sender_account_name;
        $transactions->bank_name = $request->sender_bank_name;
        $transactions->save();

        $wallet->balance += $request->amount;
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