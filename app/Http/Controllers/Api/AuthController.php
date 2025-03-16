<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\AuthService;
use App\Exceptions\CustomApiException;
use Exception;

class AuthController extends BaseController
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            $user = $this->authService->register($data);

            return response()->json([
                'status' => true,
                'message' => 'User registered successfully',
                'response_data' => [
                    'token' => $user->createToken('API Token')->plainTextToken,
                    'user' => $user
                ],
                'error_data' => [],
            ], 201);

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Log in a user.
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = $this->authService->login($credentials);

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'response_data' => [
                    'token' => $user->createToken('API Token')->plainTextToken,
                    'user' => $user
                ],
                'error_data' => [],
            ], 200);

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Get authenticated user.
     */
    public function user(Request $request)
    {
        try {
            return response()->json([
                'status' => true,
                'message' => 'Authenticated user retrieved',
                'response_data' => $request->user(),
                'error_data' => [],
            ], 200);

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Log out a user.
     */
    public function logout(Request $request)
    {
        try {
            $this->authService->logout($request->user());

            return response()->json([
                'status' => true,
                'message' => 'Logged out successfully',
                'response_data' => [],
                'error_data' => [],
            ], 200);

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Manually trigger an error.
     */
    public function triggerError($message, $details = [])
    {
        throw new CustomApiException($message, 403, $details);
    }
}
