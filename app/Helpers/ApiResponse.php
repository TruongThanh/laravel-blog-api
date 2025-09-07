<?php

namespace App\Helpers;

class ApiResponse
{
        public static function success($data = null, string $message = 'Success', int $status = 200)
        {
                return response()->json([
                        'success' => true,
                        'message' => $message,
                        'data'    => $data,
                ], $status);
        }
        public static function error(string $message = 'Error', int $status = 400, $errors = null)
        {
                return response()->json([
                        'success' => false,
                        'message' => $message,
                        'errors'  => $errors,
                ], $status);
        }

        public static function paginated($paginator, string $message = 'Success', int $status = 200)
        {
                return response()->json([
                        'success' => true,
                        'message' => $message,
                        'data'    => $paginator->items(),
                        'meta'    => [
                                'current_page' => $paginator->currentPage(),
                                'per_page'     => $paginator->perPage(),
                                'total'        => $paginator->total(),
                                'last_page'    => $paginator->lastPage(),
                                'next_page_url' => $paginator->nextPageUrl(),
                                'prev_page_url' => $paginator->previousPageUrl(),
                        ],
                ], $status);
        }
}
