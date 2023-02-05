<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $seed_data = new Data();
        $records = json_decode($seed_data->data);

        foreach($records as $record)
        {
            $previousData = Bank::where('bank_code', $record->bankCode)->first();
            if($previousData){
                continue;
            }

            $bank = new Bank();
            $bank->bank_code = $record->bankCode;
            $bank->bank_name = $record->bankName;
            $bank->bank_sort_code = $record->bankSortCode;
            $bank->save();

        }
    }
}


class Data {
    public $data = <<<EOD
    [
        {
           "bankCode": "044",
           "bankName": "Access Bank Nigeria",
           "bankSortCode": "000005"
        },
        {
           "bankCode": "035A",
           "bankName": "Alat By Wema",
           "bankSortCode": "000017"
        },
        {
           "bankCode": "044",
           "bankName": "Diamond Bank Plc",
           "bankSortCode": "000005"
        },
        {
           "bankCode": "050",
           "bankName": "Ecobank Nigeria Plc",
           "bankSortCode": "000010"
        },
        {
           "bankCode": "070",
           "bankName": "Fidelity Bank Plc",
           "bankSortCode": "000007"
        },
        {
           "bankCode": "011",
           "bankName": "First Bank Plc",
           "bankSortCode": "000016"
        },
        {
           "bankCode": "214",
           "bankName": "First City Monument Bank",
           "bankSortCode": "000003"
        },
        {
           "bankCode": "103",
           "bankName": "Globus Bank",
           "bankSortCode": "000027"
        },
        {
           "bankCode": "058",
           "bankName": "Gtbank Plc",
           "bankSortCode": "000013"
        },
        {
           "bankCode": "030",
           "bankName": "Heritage Bank",
           "bankSortCode": "000020"
        },
        {
           "bankCode": "090175",
           "bankName": "Highstreet(Rubies) Microfinance Bank",
           "bankSortCode": "090175"
        },
        {
           "bankCode": "301",
           "bankName": "Jaiz Bank",
           "bankSortCode": "000006"
        },
        {
           "bankCode": "082",
           "bankName": "Keystone Bank Plc",
           "bankSortCode": "000002"
        },
        {
           "bankCode": "100011",
           "bankName": "Kuda",
           "bankSortCode": "090267"
        },
        {
           "bankCode": "090177",
           "bankName": "Lapo Mfb",
           "bankSortCode": "090177"
        },
        {
           "bankCode": "100026",
           "bankName": "One Finance",
           "bankSortCode": "100026"
        },
        {
           "bankCode": "305",
           "bankName": "Opay",
           "bankSortCode": "100004"
        },
        {
           "bankCode": "327",
           "bankName": "Paga",
           "bankSortCode": "100002"
        },
        {
           "bankCode": "526",
           "bankName": "Parallex Mfb",
           "bankSortCode": "090004"
        },
        {
           "bankCode": "100004",
           "bankName": "Paycom(Opay)",
           "bankSortCode": "100004"
        },
        {
           "bankCode": "076",
           "bankName": "Polaris Bank",
           "bankSortCode": "000008"
        },
        {
           "bankCode": "101",
           "bankName": "Providus Bank",
           "bankSortCode": "000023"
        },
        {
           "bankCode": "090175",
           "bankName": "Rubies Mfb",
           "bankSortCode": "090175"
        },
        {
           "bankCode": "039",
           "bankName": "Stanbic Ibtc Bank Plc",
           "bankSortCode": "000012"
        },
        {
           "bankCode": "068",
           "bankName": "Standard Chartered Bank Nigeria Limited",
           "bankSortCode": "000021"
        },
        {
           "bankCode": "232",
           "bankName": "Sterling Bank Plc",
           "bankSortCode": "000001"
        },
        {
           "bankCode": "100",
           "bankName": "Suntrust Bank",
           "bankSortCode": "000022"
        },
        {
           "bankCode": "102",
           "bankName": "Titan Trust Bank",
           "bankSortCode": "000025"
        },
        {
           "bankCode": "032",
           "bankName": "Union Bank Of Nigeria Plc",
           "bankSortCode": "000018"
        },
        {
           "bankCode": "033",
           "bankName": "United Bank For Africa Plc",
           "bankSortCode": "000004"
        },
        {
           "bankCode": "215",
           "bankName": "Unity Bank Plc",
           "bankSortCode": "000011"
        },
        {
           "bankCode": "090110",
           "bankName": "Vfd Microfinance Bank",
           "bankSortCode": "090110"
        },
        {
           "bankCode": "035",
           "bankName": "Wema Bank Plc",
           "bankSortCode": "000017"
        },
        {
           "bankCode": "057",
           "bankName": "Zenith Bank Plc",
           "bankSortCode": "000015"
        }
    ]
    EOD;
}