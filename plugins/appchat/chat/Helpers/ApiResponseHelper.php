<?php

namespace AppChat\Chat\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponseHelper
{
    /**
     * Vráti JSON response v jednotnom formáte
     *
     * @param mixed $data Dáta na vrátenie
     * @param int $status HTTP status kód (default 200)
     * @param string|null $message Voliteľná správa
     * @return JsonResponse
     */
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
