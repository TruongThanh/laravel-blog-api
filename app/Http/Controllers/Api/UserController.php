<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\Api\UserResource;
use App\Services\Api\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        $user = $this->userService->updateProfile($request->validated());

        return $this->successResponse(new UserResource($user), 'Profile updated successfully');
    }
}
