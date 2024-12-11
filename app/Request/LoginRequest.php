<?php

declare(strict_types=1);

namespace App\Request;

use App\Request\Interface\LoginRequestInterface;
use Hyperf\HttpServer\Request;

class LoginRequest extends Request implements LoginRequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules():array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages():array
    {
        return [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password' => 'required|string|min:8',
        ];
    }

    public function getEmail(): string
    {
        return $this->input('email');
    }

    public function getPassword(): string
    {
        return $this->input('password');
    }

}