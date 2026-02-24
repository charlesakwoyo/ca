<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWalletRequest;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;

class WalletController extends Controller
{
    public function store(StoreWalletRequest $request, User $user): JsonResponse
    {
        $wallet = $user->wallets()->create($request->validated());

        return response()->json([
            'message' => 'Wallet created successfully.',
            'data' => [
                'id' => $wallet->id,
                'user_id' => $wallet->user_id,
                'name' => $wallet->name,
                'balance' => 0.0,
                'created_at' => $wallet->created_at,
            ],
        ], 201);
    }

    public function show(Wallet $wallet): JsonResponse
    {
        $wallet->load('transactions');

        return response()->json([
            'data' => [
                'id' => $wallet->id,
                'user_id' => $wallet->user_id,
                'name' => $wallet->name,
                'balance' => $wallet->balance,
                'transactions' => $wallet->transactions->map(fn ($transaction): array => [
                    'id' => $transaction->id,
                    'type' => $transaction->type,
                    'amount' => (float) $transaction->amount,
                    'description' => $transaction->description,
                    'created_at' => $transaction->created_at,
                ])->values(),
            ],
        ]);
    }
}
