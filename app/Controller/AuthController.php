<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\Auth\UserNotFoundException;
use App\Exception\Auth\WrongPasswordException;
use App\Request\LoginRequest;
use App\Request\UserRegisterRequest;
use App\Service\Interface\AuthServiceInterface;
use Psr\Http\Message\ResponseInterface;

class AuthController extends AbstractController
{
    public function __construct(private AuthServiceInterface $authService)
    {}

    public function login(LoginRequest $request): ResponseInterface
    {
        try {
            $token = $this->authService->login($request);
            return $this->sendResponse('User logged successfully', 200, [ 'token' => $token ]);
        } catch (UserNotFoundException $th) {
            return $this->sendError('User not found', 404);
        } catch (WrongPasswordException $th) {
            return $this->sendError('Wrong password.', 401);
        } catch (\Throwable $th) {
            return $this->sendError('Unexpected error', 500);
        }
    }

    public function register(UserRegisterRequest $request): ResponseInterface
    {
        try {
            $token = $this->authService->register($request);
            return $this->sendResponse('User registered successfully', 200, [ 'token' => $token ]);
        } catch (\Throwable $th) {
            return $this->sendError('Unexpected error', 500);
        }
    }
}