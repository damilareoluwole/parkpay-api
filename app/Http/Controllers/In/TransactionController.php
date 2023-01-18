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
}