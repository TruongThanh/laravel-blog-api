<?php

namespace App\Services\Api;

use App\Repositories\Api\Interfaces\UserRepositoryInterface;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function updateProfile(array $data)
    {
        if (isset($data['avatar'])) {
            $avatarPath = $data['avatar']->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }
        return $this->userRepository->update($data);
    }
}
