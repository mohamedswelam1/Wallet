<?php

namespace App\Repositories;

use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class WalletRepository
{
    public  function createWallet($userId)
    {
        return Wallet::create(['user_id' => $userId]);
    }

    public function getWalletByUserId(int $userId)
    {
        return Wallet::where('user_id', $userId)->first();
    }
    public function updateBalance(Wallet  $wallet,$balance )
    {
        return $wallet->update(['balance' => $balance]);
    }
}
