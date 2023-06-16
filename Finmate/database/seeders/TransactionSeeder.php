<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        $assetNos = range(1, 61);
        $types = ['0', '1'];
        $payeeChars = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $amountMin = 1000;
        $amountMax = 900000;

        for ($i = 1; $i <= 1000; $i++) {
            $transaction = new Transaction();
            $transaction->assetno = $assetNos[array_rand($assetNos)];
            $transaction->type = $types[array_rand($types)];
            $transaction->trantime = Carbon::now()->subYear()->addDays(rand(0, 365));
            $transaction->payee = Str::random(12);
            $transaction->amount = mt_rand($amountMin, $amountMax);
            $transaction->char = $payeeChars[array_rand($payeeChars)];
            $transaction->save();
        }
    }
}
