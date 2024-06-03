<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        $user = $this->userRepository->create($data);
        return [
            'user' => $user,
            'token' => $user->createToken("API TOKEN")->plainTextToken,
        ];
    }

    public function login(array $data)
    {
        if (!Auth::attempt($data)) {
            throw new \Exception('Email and/or password incorrect');
        }

        $user = $this->userRepository->findByEmail($data['email']);
        return [
            'user' => $user,
            'token' => $user->createToken("API TOKEN")->plainTextToken,
        ];
    }

    public function profile()
    {
        return auth()->user();
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
    }
}