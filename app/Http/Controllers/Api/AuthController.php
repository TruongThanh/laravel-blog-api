<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRquest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\Api\AuthResource;
use App\Services\Api\Auth\AuthServiceInterface;
use Illuminate\Http\Request;

class AuthController extends BaseApiController
{
    protected AuthServiceInterface $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param RegisterRequest $request
     * Register a user
     */
    public function register(RegisterRequest $request)
    {
        return $this->successResponse($this->authService->register($request->validated()), 'Register is successfully', 201);
    }

    /**
     * @param LoginReques $request
     * Login a user
     */
    public function login(LoginRquest $request)
    {
        $result = $this->authService->login($request->validated());
        if (!$result) {
            return $this->errorResponse('Invalid credentials', 401);
        }
        return $this->successResponse($result, 'Login is successfully');
    }

    /**
     * @param Request $request
     * Login a user
     */
    public function me(Request $request)
    {
        $result = $this->authService->me($request->user());
        return $this->successResponse(new AuthResource($result), '');
    }

     /**
     * @param Request $request
     * Login a user
     */
    public function logout(Request $request)
    {
        $this->authService->logout($request->user());
        return $this->successResponse(null, 'Logged out');
    }
}
