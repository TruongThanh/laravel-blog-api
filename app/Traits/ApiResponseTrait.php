<?php

namespace App\Traits;

use App\Helpers\ApiResponse;

trait ApiResponseTrait
{
    protected function successResponse($data = null, string $message = 'Success', int $status = 200)
    {
        return ApiResponse::success($data, $message, $status);
    }

    protected function errorResponse(string $message = 'Error', int $status = 400, $errors = null)
    {
        return ApiResponse::error($message, $status, $errors);
    }

    protected function paginatedResponse($paginator, string $message = 'Success', int $status = 200)
    {
        return ApiResponse::paginated($paginator, $message, $status);
    }
}
