<?php

namespace App\Http\Controllers\Api;

// use App\Http\Resources\UserResource;
// use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    // protected $userService;

    // public function __construct(UserService $userService)
    // {
    //     $this->userService = $userService;
    // }

    public function login()
    {
        $user = User::first();
        // dd($user);
        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'data' => $user,
        ]);
    }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //     ]);

    //     $user = $this->userService->createUser($data);
    //     return response()->json($user, 201);
    // }
}

