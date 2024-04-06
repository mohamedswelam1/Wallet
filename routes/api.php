<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [\App\Http\Controllers\API\Auth\LoginController::class, 'login']);
Route::post('register', [\App\Http\Controllers\API\Auth\RegisterController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/wallet/balance', [\App\Http\Controllers\API\WalletController::class, 'checkBalance']);
    Route::post('/wallet/top-up', [\App\Http\Controllers\API\WalletController::class, 'topUp']);
    Route::post('/wallet/transfer', [\App\Http\Controllers\API\WalletController::class, 'transfer']);
    Route::get('/transactions', [\App\Http\Controllers\API\TransactionController::class, 'transactionHistory']);
});
