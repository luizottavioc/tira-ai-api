<?php

declare(strict_types=1);

namespace App\Service\Interface;

use App\Model\User;
use App\Request\Interface\LoginRequestInterface;
use App\Request\Interface\UserRegisterRequestInterface;

interface AuthServiceInterface 
{
    static function genToken(User $user, int $expirationTime = null): string;
    static function decodeToken(string $token): object;
    public function login(LoginRequestInterface $request): array;
    public function register(UserRegisterRequestInterface $request): array;
    public function getMe(string $token): array;
}