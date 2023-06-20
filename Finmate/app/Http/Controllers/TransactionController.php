<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index($userid)
    {
        $transactions = Transaction::join('assets', 'transactions.assetno', '=', 'assets.assetno')
                        ->select('transactions.*')
                        ->where('assets.userid', $userid)
                        ->get();
        return view('transactions', ['transactions' => $transactions]);
    }
}
