<?php

declare(strict_types=1);

namespace App\Service\Interface;

use App\Request\Interface\LoginRequestInterface;
use App\Request\Interface\UserRegisterRequestInterface;

interface AuthServiceInterface 
{
    public function login(LoginRequestInterface $request): array;
    public function register(UserRegisterRequestInterface $request): array;
    // public function logout(string $token): void;
    // public function refresh(string $token): string;
}