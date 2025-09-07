<?php

namespace App\Services\Api\Auth;

use App\Models\User;

interface AuthServiceInterface
{
    public function register(array $data): array;
    public function login(array $credentials): ?array;
    public function logout(User $user): void;
    public function me(User $user): User;
}
