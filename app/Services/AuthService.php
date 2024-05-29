<?php

namespace App\Services;

use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Log;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        Log::info('AuthService called');
        $this->authRepository = $authRepository;
    }

    public function register($data)
    {
        return $this->authRepository->register($data);
    }

    public function login($data)
    {
        return $this->authRepository->login($data);
    }

    public function logout()
    {
        return $this->authRepository->logout();
    }
}
