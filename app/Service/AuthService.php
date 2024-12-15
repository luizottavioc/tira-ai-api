<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\Auth\UserNotFoundException;
use App\Exception\Auth\WrongPasswordException;
use App\Model\User;
use App\Request\Interface\LoginRequestInterface;
use App\Request\Interface\UserRegisterRequestInterface;
use App\Service\Interface\AuthServiceInterface;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use function Hyperf\Support\env;

class AuthService implements AuthServiceInterface
{
    private const int EXPIRATION_SECONDS = 3600;
    private const string ALGORITHM = 'HS256';

    private function expirationTime(): int
    {
        return time() + self::EXPIRATION_SECONDS;
    }

    private function genToken(User $user, int $expirationTime = null): string
    {
        $expirationTime ??= $this->expirationTime();
        $tokenPayload = [
            'id' => $user->id,
            'email' => $user->email,
            'iat' => time(),
            'exp' => $expirationTime,
        ];

        return JWT::encode(
            $tokenPayload, 
            env('JWT_SECRET_KEY'), 
            self::ALGORITHM
        );
    }

    static function decodeToken(string $token): object
    {
        return JWT::decode(
            $token, 
            new Key(env('JWT_SECRET_KEY'), self::ALGORITHM)
        );
    }

    public function login(LoginRequestInterface $request): array
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

        $expirationTime = $this->expirationTime();
        $expiresIn = Carbon::now()->addSeconds(self::EXPIRATION_SECONDS);
        $token = $this->genToken($user, $expirationTime);

        return [ 'token' => $token, 'expires_in' => $expiresIn, 'user' => $user->toArray() ];
    }

    public function register(UserRegisterRequestInterface $request): array
    {
        $user = User::create([
            'name' => $request->getName(),
            'email' => $request->getEmail(),
            'cellphone' => $request->getCellphone(),
            'password' => password_hash($request->getPassword(), PASSWORD_DEFAULT),
        ]);

        $expirationTime = $this->expirationTime();
        $expiresAt = Carbon::now()->addSeconds(self::EXPIRATION_SECONDS);
        $token = $this->genToken($user, $expirationTime);

        return [ 'token' => $token, 'expires_at' => $expiresAt, 'user' => $user->toArray() ];
    }

}