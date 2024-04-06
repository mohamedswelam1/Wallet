<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(public TransactionRepository $transactionRepository){}

    public function transactionHistory(Request $request)
    {
        try {
            $transactions = $this->transactionRepository->getTransactions();
            return ApiResponse::success(['transactions' => new TransactionResource($transactions)], 'transactions history');

        } catch (\Exception $e) {
            return ApiResponse::error('Server error', 500);
        }
    }
}
