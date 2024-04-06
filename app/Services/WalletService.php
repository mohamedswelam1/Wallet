<?php
namespace App\Services;

use App\Exceptions\InsufficientBalanceException;
use App\Exceptions\WalletNotFoundException;
use App\Models\User;
use App\Models\Wallet;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;
use Illuminate\Support\Facades\Auth;

class WalletService
{
    private $walletRepository ;
    private $transactionService ;

    public function __construct(UserRepository $userRepository , WalletRepository $walletRepository , TransactionService $transactionService)
    {
        $this->walletRepository = $walletRepository;
        $this->transactionService = $transactionService;
    }
    public function updateBalanceForWallet($balance)
    {
        $wallet= Wallet::where('user_id' , Auth::id());
        $wallet = $this->walletRepository->updateBalance($wallet->id,$balance);
        if ($wallet ){
            return $wallet;
        }
        return false;
    }
    public function transfer($data)
    {
        $sender = User::find($data['sender_id']);
        $recipient = User::find($data['recipient_id']);
        $amount = $data['amount'];

        // Check if sender has sufficient balance
        if ($sender->balance < $amount ) {
            throw new InsufficientBalanceException('Insufficient balance');
        }
        if (!$recipient ) {
            throw new WalletNotFoundException('recipient not exist');
        }

        // Calculate transaction fee if amount exceeds $25
        $transactionFee = ($amount > 25) ? (2.5 + (0.1 * $amount)) : 0;

        $data['fees'] = $transactionFee;
        $this->transactionService->deposit($recipient->id, $data);
        $this->transactionService->withdraw($recipient->id, $data);

        // Perform the transfer
        $senderWallet=Wallet::where('user_id',$sender->id)->first();
        $recipientWallet = Wallet::where('user_id',$recipient->id)->first();
        $senderWallet->balance -= $amount + $transactionFee;
        $recipientWallet->balance += $amount;

        $this->walletRepository->updateBalance($recipientWallet ,$recipientWallet->balance);
        return  $this->walletRepository->updateBalance($senderWallet , $senderWallet->balance);

    }
    public function getCurrentBalance(User $user)
    {
        return $user->wallet->balance;
    }

}
