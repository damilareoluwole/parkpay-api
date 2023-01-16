<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DummyTransactionData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [[
            "id" => 1,
            "user_id" => 1,
            "type" => "CREDIT",
            "wallet_id" => 1,
            "amount" => 3000,
            "account_no" => "0031798760",
            "account_name" => "Damilare Oluwole",
            "bank_name" => "First Bank"
        ],
        [
            "id" => 2,
            "user_id" => 1,
            "type" => "CREDIT",
            "wallet_id" => 1,
            "amount" => 1000,
            "account_no" => "3331798980",
            "account_name" => "Joe Kumoye",
            "bank_name" => "First Bank"
        ],
        [
            "id" => 3,
            "user_id" => 1,
            "type" => "DEBIT",
            "wallet_id" => 1,
            "amount" => 3000,
            "account_no" => "1321798769",
            "account_name" => "Opeyemi Ibuoye",
            "bank_name" => "Zenith Bank"
        ],
        [
            "id" => 4,
            "user_id" => 1,
            "type" => "CREDIT",
            "wallet_id" => 1,
            "amount" => 5000,
            "account_no" => "0221798761",
            "account_name" => "Stanley Aloh",
            "bank_name" => "Access Bank"
        ],
        [
            "id" => 5,
            "user_id" => 1,
            "type" => "DEBIT",
            "wallet_id" => 1,
            "amount" => 2000,
            "account_no" => "2256780092",
            "account_name" => "Ifeanyi Virox",
            "bank_name" => "Eco Bank"
        ],
        [
            "id" => 6,
            "user_id" => 1,
            "type" => "DEBIT",
            "wallet_id" => 1,
            "amount" => 1500,
            "account_no" => "7654318923",
            "account_name" => "Ronke Ibitoye",
            "bank_name" => "Union Bank"
        ],
        [
            "id" => 7,
            "user_id" => 1,
            "type" => "CREDIT",
            "wallet_id" => 1,
            "amount" => 9000,
            "account_no" => "0031798760",
            "account_name" => "Damilare Oluwole",
            "bank_name" => "First Bank"
        ]];

        foreach ($data as $item) {
            Transaction::create($item);
        }
    }
}