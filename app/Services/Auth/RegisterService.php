<?php
namespace App\Services\Auth;

use App\Models\User;
use App\Models\Wallet;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    public function register($userData)
    {

       $user= UserRepository::createUser($userData) ;
       $wallet= WalletRepository::createWallet($user->id) ;
        if ($user && $wallet) {
            return Auth::user();
        }
        return false;
    }

}
