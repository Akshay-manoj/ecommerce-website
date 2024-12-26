<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait RespondWithJson
{
    protected function error(string $message, int $status = 500, $error = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'error' => $error,
        ], $status);
    }

    protected function success(string $message, $data = [], int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }
}
