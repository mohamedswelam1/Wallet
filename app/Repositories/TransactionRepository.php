<?php

namespace App\Repositories;

use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionRepository
{
    public function createTransaction(array $transactionData): Transaction
    {
        return Transaction::create($transactionData);
    }

    public function getTransactions()
    {
        $wallet= Wallet::where('user_id', Auth::id())->first();
        return Transaction::where('wallet_id' , '=' ,$wallet->id)->get();
    }
}
