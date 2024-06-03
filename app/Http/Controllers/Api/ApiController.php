<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthServiceInterface;

class ApiController extends Controller
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $result = $this->authService->register($request->all());
            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'token' => $result['token'],
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $result = $this->authService->login($request->only(['email', 'password']));
            return response()->json([
                'status' => true,
                'message' => 'User logged in successfully',
                'token' => $result['token'],
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 401);
        }
    }

    public function profile()
    {
        return response()->json([
            'status' => true,
            'message' => 'Profile Information',
            'data' => $this->authService->profile(),
        ], 200);
    }

    public function logout()
    {
        $this->authService->logout();
        return response()->json([
            'status' => true,
            'message' => 'User logged out',
        ], 200);
    }
}