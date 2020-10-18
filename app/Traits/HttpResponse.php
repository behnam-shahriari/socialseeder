<?php

namespace App\Traits;


use Illuminate\Http\JsonResponse;

trait HttpResponse {

    public function unauthenticated(string $message = 'unauthenticated'): JsonResponse {
        return $this->error($message, 401);
    }

    public function unauthorized(string $message = 'unauthorized'): JsonResponse {
        return $this->error($message, 403);
    }

    public function badParameters( string $message = 'Bad parameters',int $code = 422) {
        return $this->error($message,$code);
    }

    public function success($data, string $message = 'Success', array $extra = [], int $code = 200) {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'extra' => $extra
        ], $code);
    }

    public function error(string $message = 'error', int $code = 400, ?array $extra = []): JsonResponse {
        return response()->json([
            'message' => $message,
            'code' => $code,
            'extra' => $extra
        ], $code);
    }
}
