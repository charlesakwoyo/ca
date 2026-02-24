<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    public function store(StoreTransactionRequest $request, Wallet $wallet): JsonResponse
    {
        $transaction = $wallet->transactions()->create($request->validated());

        $wallet->load('transactions');

        return response()->json([
            'message' => 'Transaction added successfully.',
            'data' => [
                'id' => $transaction->id,
                'wallet_id' => $wallet->id,
                'type' => $transaction->type,
                'amount' => (float) $transaction->amount,
                'description' => $transaction->description,
                'wallet_balance' => $wallet->balance,
                'created_at' => $transaction->created_at,
            ],
        ], 201);
    }
}
