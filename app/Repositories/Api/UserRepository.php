<?php

namespace App\Repositories\Api;

use App\Models\User;
use App\Repositories\Api\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    // Implement the methods defined in UserRepositoryInterface
    public function findbyId(int $id)
    {
        // Implementation for finding a user by ID
        return User::findOrFail($id);
    }

    public function update(array $data)
    {
        // Implementation for updating user data
        $user = auth()->user();
        $user->update($data);
        return $user;
    }
}

