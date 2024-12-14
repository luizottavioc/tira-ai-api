<?php

declare(strict_types=1);

namespace App\Request;

use App\Request\Interface\LoginRequestInterface;
use Hyperf\Validation\Request\FormRequest;

class LoginRequest extends FormRequest implements LoginRequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules():array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages():array
    {
        return [
            'email.required' => 'E-mail is required.',
            'email.email' => 'The email must be a valid email address.',
            'password.required' => 'Password is required.',
            'password' => 'Password must be at least 8 characters.',
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