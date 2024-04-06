<?php

namespace App\Http\Controllers\API;

use App\Exceptions\InsufficientBalanceException;
use App\Exceptions\WalletNotFoundException;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Transaction\TransferRequest;
use App\Http\Requests\API\Wallet\TopUpWalletRequest;
use App\Http\Resources\WalletResource;
use App\Services\TransactionService;
use App\Services\WalletService;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    private $walletService ;

    public function __construct( WalletService $walletService , TransactionService $transactionService )
    {
        $this->walletService = $walletService;

    }
    public function topUp(TopUpWalletRequest $request)
    {
        try {
            $wallet= $this->walletService->updateBalanceForWallet($request->validated());
            if ($wallet){
                return ApiResponse::success(['wallet' => new WalletResource($wallet)], 'Funding successful');
            }
            return ApiResponse::error('An error occurred during Funding', 401);

        }catch (\Exception $e){
            return ApiResponse::error('Server error', 500);

        }

    }

    public function transfer(TransferRequest $request)
    {
        try {
            $wallet = $this->walletService->transfer( $request->validated());
            return ApiResponse::success(['wallet' => new WalletResource($wallet)], 'Transfer successful.');
        } catch (WalletNotFoundException | InsufficientBalanceException  $e) {
            return ApiResponse::error('An error occurred during Funding', 401);
        } catch (\Exception $e) {
            // Catch any other unexpected exceptions
            return ApiResponse::error('Transfer failed.', 500);

        }
    }

    public function checkBalance(Request $request)
    {
        try {
            $user = $request->user();
            $balance = $this->walletService->getCurrentBalance($user);
            return ApiResponse::success(['balance' => $balance], 'Transfer successful.');
        } catch (\Exception $e) {
            return ApiResponse::error('Server error', 500);
        }
    }
}
