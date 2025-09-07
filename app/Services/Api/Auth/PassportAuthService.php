<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Api\Auth\AuthServiceInterface;
use Illuminate\Support\Facades\Http;

class PassportAuthService implements AuthServiceInterface
{
    public function login(array $credentials): ?string
    {
        // Gửi request đến /oauth/token
        $response = Http::asForm()->post(config('services.passport.login_endpoint'), [
            'grant_type' => 'password',
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'username' => $credentials['email'],
            'password' => $credentials['password'],
        ]);

        if ($response->failed()) {
            return null;
        }

        return $response->json('access_token');
    }

    public function logout(User $user): void
    {
        // gọi API revoke token hoặc xóa token
    }

    public function register(array $data): User
    {
        return User::create($data); // hoặc gọi API riêng
    }

    public function user(): ?User
    {
        return auth()->user();
    }
}
