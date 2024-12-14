<?php

declare(strict_types=1);

namespace App\Request;

use App\Request\Interface\UserRegisterRequestInterface;
use Hyperf\Validation\Request\FormRequest;

class UserRegisterRequest extends FormRequest implements UserRegisterRequestInterface
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
            'email.required' => 'E-mail is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email already exists.',
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name must be at most 60 characters.',
            'cellphone.required' => 'Cellphone is required.',
            'cellphone.string' => 'Cellphone must be a string.',
            'cellphone.max' => 'Cellphone must be at most 20 characters.',
            'cellphone.unique' => 'The cellphone already exists.',
            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a string.',
            'password.min' => 'Password must be at least 8 characters.',
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