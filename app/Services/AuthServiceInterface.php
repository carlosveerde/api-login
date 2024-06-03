<?php

namespace App\Services;

interface AuthServiceInterface
{
    public function register(array $data);
    public function login(array $data);
    public function profile();
    public function logout();
}