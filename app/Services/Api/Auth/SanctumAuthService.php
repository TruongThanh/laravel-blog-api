<?php

namespace App\Services\Api\Auth;

use App\Http\Resources\Api\AuthResource;
use App\Models\Api\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SanctumAuthService implements AuthServiceInterface
{
    public function user(): ?User
    {
        return Auth::user();
    }

    /**
     * @param array $data
     * Register a User
     */
    public function register(array $data): array
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        return [
            'user'  =>  new AuthResource($user),
            'token' => $token,
        ];
    }

    /**
     * @param array $credentials
     * Register a User
     */
    public function login(array $credentials): ?array
    {
        if (!Auth::attempt($credentials)) {
            return null;
        }

        $user  = Auth::user();
        $token = $user->createToken('api_token')->plainTextToken;

        return [
            'user'  => new AuthResource($user),
            'token' => $token,
        ];
    }

    /**
     * @param User $user
     * Register a User
     */
    public function logout(User $user): void
    {
        $user->currentAccessToken()->delete();
    }

    /**
     * @param User $user
     * Register a User
     */
    public function me(User $user): User
    {
        return $user;
    }
}
