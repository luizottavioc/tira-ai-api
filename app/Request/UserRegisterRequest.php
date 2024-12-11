<?php

declare(strict_types=1);

namespace App\Request;

use App\Request\Interface\UserRegisterRequestInterface;
use Hyperf\HttpServer\Request;

class UserRegisterRequest extends Request implements UserRegisterRequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules():array
    {
        return [
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:60',
            'cellphone' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages():array
    {
        return [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'O e-mail informado ja foi cadastrado.',
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome deve ter no máximo 60 caracteres.',
            'cellphone.required' => 'O campo telefone é obrigatório.',
            'cellphone.string' => 'O campo telefone deve ser uma string.',
            'cellphone.max' => 'O campo telefone deve ter no máximo 20 caracteres.',
            'cellphone.unique' => 'O telefone informado ja foi cadastrado.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.string' => 'O campo senha deve ser uma string.',
            'password.min' => 'O campo senha deve ter no máximo 8 caracteres.',
        ];
    }

    public function getEmail(): string
    {
        return $this->input('email');
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getCellphone(): string
    {
        return $this->input('cellphone');
    }

    public function getPassword(): string
    {
        return $this->input('password');
    }
}