<?php
namespace App\Services;


use App\Models\Wallet;
use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\Auth;

class TransactionService
{
    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function deposit($recipient,$TransferData)
    {
        $wallet = Wallet::find($recipient);

        return $this->transactionRepository->createTransaction([
            'sender' => Auth::id(),
            'receiver'=> $recipient,
            'wallet_id' => $wallet->id,
            'type' => 'withdraw',
            'amount' => $TransferData['amount'],
            'transaction_fee' => $TransferData['fees'],
        ]);
    }
    public function withdraw($recipient,$TransferData)
    {
        $wallet = Wallet::find(Auth::id());

        return $this->transactionRepository->createTransaction([
            'sender' => Auth::id(),
            'receiver'=> $recipient,
            'wallet_id' => $wallet->id,
            'type' => 'deposit',
            'amount' => $TransferData['amount'],
            'transaction_fee' => $TransferData['fees'],
        ]);
    }

}
