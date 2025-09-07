<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller  as BaseController;

class Controller extends BaseController
{
    use Authorizable, ValidatesRequests;

    protected function success($data = null, string $message = 'Success', int $status = 200)
    {
        return response()->json([
            'message' => $message,
            'data'    => $data,
        ], $status);
    }

    protected function error(string $message = 'Error', int $status = 400)
    {
        return response()->json([
            'message' => $message,
            'data'    => null,
        ], $status);
    }
}

