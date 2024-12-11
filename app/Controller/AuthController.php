<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\Interface\UserRegisterRequestInterface;
use App\Request\Interface\LoginRequestInterface;
use App\Service\Interface\AuthServiceInterface;

class AuthController extends AbstractController
{
    public function __construct(private AuthServiceInterface $authService)
    {}

    public function login(LoginRequestInterface $request)
    {
        return $this->authService->login($request);
    }

    public function register(UserRegisterRequestInterface $request)
    {
        // $result = $this->authService->register($request);

        // if ($result) {
        //     return $this->response->json([
        //         'message' => 'Usuário cadastrado com sucesso.'
        //     ])->withStatus(201);
        // } else {
        //     return $this->response->json([
        //         'error' => 'Não foi possível realizar o cadastro.'
        //     ])->withStatus(500);
        // } 
        return $this->authService->register($request);

    }

}