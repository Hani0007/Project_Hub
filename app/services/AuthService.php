<?php

namespace App\services;

use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(array $data)
    {
        return $this->authRepository->register($data);
    }

    public function login(array $data)
    {
        $result = $this->authRepository->login($data);
        if (!$result) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }
        return $result;
    }

    public function logout()
    {
        return $this->authRepository->logout();
    }
}
