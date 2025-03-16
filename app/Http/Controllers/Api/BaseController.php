<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use App\Exceptions\CustomApiException;
use Exception;

class BaseController extends Controller
{
    protected function sendResponse($data = [], $message, $status = true, $error = [], $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'response_data' => $data,
            'error_data' => [],
        ], $statusCode);
    }

    protected function handleException(Exception $e): JsonResponse
    {
        if ($e instanceof ValidationException) {
            $this->sendResponse([], 'Validation failed', false, $e->errors(), 422);
        }

        if ($e instanceof QueryException) {
            $errorData = (env('APP_ENV') === 'local' || env('APP_ENV') === 'development') ? ['error' => $e->getMessage()] : [];
            $this->sendResponse([], 'Database error occurred', false, $errorData, 500);
        }

        if ($e instanceof CustomApiException) {
            $error = $e->getErrorData() ?? [];
            $this->sendResponse([], $e->getMessage(), false, $error, $e->getStatus());
        }

        $errorData = (env('APP_ENV') === 'local' || env('APP_ENV') === 'development') ? ['error' => $e->getMessage()] : [];
        return $this->sendResponse([], 'Something went wrong', false, $errorData, 500);
    }
}
