<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(StoreUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['password'] = $data['password'] ?? Str::random(20);

        $user = User::create($data);

        return response()->json([
            'message' => 'User account created successfully.',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ], 201);
    }

    public function show(User $user): JsonResponse
    {
        $user->load('wallets.transactions');

        $wallets = $user->wallets->map(function (Wallet $wallet): array {
            return [
                'id' => $wallet->id,
                'name' => $wallet->name,
                'balance' => $wallet->balance,
                'created_at' => $wallet->created_at,
            ];
        })->values();

        return response()->json([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'wallets' => $wallets,
                'total_balance' => (float) $wallets->sum('balance'),
            ],
        ]);
    }
}
