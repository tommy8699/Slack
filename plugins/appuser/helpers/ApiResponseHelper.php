<?php

namespace AppUser\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponseHelper
{
    public static function jsonResponse($data, int $status = 200, ?string $message = null): JsonResponse
    {
        $response = [
            'success' => $status >= 200 && $status < 300,
            'data' => $data,
            'message' => $message,
            'status' => $status,
        ];

        return response()->json($response, $status);
    }
}
