<?php

namespace App\Repositories;

use App\Models\Wallet;
use App\Models\Transaction;

class TransactionRepository
{
    public function createTransaction(array $transactionData): Transaction
    {
        return Transaction::create($transactionData);
    }

    public function getTransactions()
    {
        return Transaction::where('sender' , '=' , auth()->id());
    }
}
