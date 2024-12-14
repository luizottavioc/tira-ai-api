<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\Auth\UserNotFoundException;
use App\Exception\Auth\WrongPasswordException;
use App\Model\User;
use App\Request\Interface\LoginRequestInterface;
use App\Request\Interface\UserRegisterRequestInterface;
use App\Service\Interface\AuthServiceInterface;
use Firebase\JWT\JWT;
use function Hyperf\Support\env;

class AuthService implements AuthServiceInterface
{
    protected $jwtSecretKey;
    private const int EXPIRATION_SECONDS = 3600;

    public function __construct()
    {
        $this->jwtSecretKey = env('JWT_SECRET_KEY');
    }

    private function genToken(User $user): string
    {
        $tokenPayload = [
            'uuid' => $user->uuid,
            'email' => $user->email,
            'iat' => time(),
            'exp' => time() + self::EXPIRATION_SECONDS,
        ];

        return JWT::encode($tokenPayload, $this->jwtSecretKey, 'HS256');
    }

    public function login(LoginRequestInterface $request): string
    {
        $email = $request->getEmail();

        $user = User::where('email', $email)->first();
        if (!$user) {
            throw new UserNotFoundException();
        }

        $password = $request->getPassword();

        if (!password_verify($password, $user->password)) {
            throw new WrongPasswordException();
        }

        return $this->genToken($user);
    }

    public function register(UserRegisterRequestInterface $request): string
    {
        $user = User::create([
            'name' => $request->getName(),
            'email' => $request->getEmail(),
            'cellphone' => $request->getCellphone(),
            'password' => password_hash($request->getPassword(), PASSWORD_DEFAULT),
        ]);

        return $this->genToken($user);
    }

}