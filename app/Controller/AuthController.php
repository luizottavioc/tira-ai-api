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
            $loginResponse = $this->authService->login($request);
            return $this->sendResponse('User logged successfully', 200, $loginResponse);
        } catch (UserNotFoundException | WrongPasswordException $exception) {
            return $this->sendError($exception->getMessage(), $exception->getCode());
        } catch (\Throwable $th) {
            return $this->sendError('Unexpected error', 500);
        }
    }

    public function register(UserRegisterRequest $request): ResponseInterface
    {
        try {
            $registerResponse = $this->authService->register($request);
            return $this->sendResponse('User registered successfully', 200, $registerResponse);
        } catch (\Throwable $th) {
            return $this->sendError('Unexpected error', 500);
        }
    }

    public function me(): ResponseInterface
    {
        try {
            $token = (string) $this->container->get('token');
            $meResponse = $this->authService->getMe($token);
            return $this->sendResponse('Logged user data', 200, $meResponse);
        } catch (\Throwable $th) {
            return $this->sendError('Unexpected error', 500);
        }
    }

    public function refreshToken(): ResponseInterface
    {
        try {
            $token = (string) $this->container->get('token');
            $newToken = $this->authService->refreshToken($token);
            return $this->sendResponse('Refreshed token', 200, [ 'token' => $newToken ]);
        } catch (\Throwable $th) {
            return $this->sendError('Unexpected error', 500);
        }
    }
}