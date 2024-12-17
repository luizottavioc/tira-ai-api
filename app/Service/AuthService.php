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

    static function expirationTime(): int
    {
        return time() + self::EXPIRATION_SECONDS;
    }

    static function genToken(User $user, int $expirationTime = null): string
    {
        $expirationTime ??= self::expirationTime();
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

    static function refreshToken(string $token): string
    {
        $decodedToken = self::decodeToken($token);
        $user = User::where('id', $decodedToken->id)->first();
        return self::genToken($user);
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

        $expirationTime = self::expirationTime();
        $expiresIn = Carbon::now()->addSeconds(self::EXPIRATION_SECONDS);
        $token = self::genToken($user, $expirationTime);

        return [ 
            'token' => $token, 
            'expires_in' => $expiresIn, 
            'user' => $user->toArray() 
        ];
    }

    public function register(UserRegisterRequestInterface $request): array
    {
        $user = User::create([
            'name' => $request->getName(),
            'email' => $request->getEmail(),
            'cellphone' => $request->getCellphone(),
            'password' => password_hash($request->getPassword(), PASSWORD_DEFAULT),
        ]);

        $expirationTime = self::expirationTime();
        $expiresAt = Carbon::now()->addSeconds(self::EXPIRATION_SECONDS);
        $token = self::genToken($user, $expirationTime);

        return [ 
            'token' => $token, 
            'expires_at' => $expiresAt, 
            'user' => $user->toArray() 
        ];
    }

    public function getMe(string $token): array
    {
        $decodedToken = self::decodeToken($token);
        $user = User::where('id', $decodedToken->id)->first();
        $expiresAt = new Carbon($decodedToken->exp);

        return [
            'token' => $token,
            'expires_at' => $expiresAt,
            'user' => $user->toArray()
        ];
    }

    public function logout(string $token): void
    {
        $decodedToken = self::decodeToken($token);
        $user = User::where('id', $decodedToken->id)->first();
        $user->tokens()->delete();
    }
}