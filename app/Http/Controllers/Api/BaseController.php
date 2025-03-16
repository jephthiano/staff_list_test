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
    protected function handleException(Exception $e): JsonResponse
    {
        if (env('APP_ENV') === 'local' || env('APP_ENV') === 'development') {
            $errorData = ['error' => $e->getMessage()];
        }else{
            $errorData = [];
        }
        
        
        if ($e instanceof ValidationException) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'response_data' => [],
                'error_data' => $e->errors()
            ], 422);
        }

        if ($e instanceof QueryException) {
            return response()->json([
                'status' => false,
                'message' => 'Database error occurred',
                'response_data' => [],
                'error_data' => $errorData
            ], 500);
        }

        if ($e instanceof CustomApiException) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(), // Use the message from the custom exception
                'response_data' => [],
                'error_data' => $e->getErrorData() ?? []
            ], $e->getStatus());
        }

        return response()->json([
            'status' => false,
            'message' => 'Something went wrong',
            'response_data' => [],
            'error_data' => $errorData,
        ], 500);
    }
}
