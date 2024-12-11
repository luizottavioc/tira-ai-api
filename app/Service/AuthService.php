<?php

declare(strict_types=1);

namespace App\Service;

use App\Request\Interface\LoginRequestInterface;
use App\Request\Interface\UserRegisterRequestInterface;
use App\Service\Interface\AuthServiceInterface;
use function Hyperf\Support\env;

class AuthService implements AuthServiceInterface
{
    protected $jwtSecretKey;

    public function __construct()
    {
        $this->jwtSecretKey = env('JWT_SECRET_KEY');
    }

    public function login(LoginRequestInterface $request): string
    {
        // $email = $request->input('email');
        // $password = $request->input('password');

        // $user = $this->getUserByEmail($email);

        // if (!$user) {
        //     return ['error' => 'Usuário não encontrado'];
        // }

        // if (password_verify($password, $user->password)) {
        //     $tokenPayload = [
        //         'uuid' => $user->uuid,
        //         'email' => $user->email,
        //         'iat' => time(),
        //     ];

        //     $token = JWT::encode($tokenPayload, $this->jwtSecretKey, 'HS256');

        //     return ['token' => $token];
        // } else {
        //     return ['error' => 'Senha incorreta'];
        // }

        return 'token';
    }

    public function register(UserRegisterRequestInterface $request): string
    {
        // $user = User::create([
        //     'uuid' => Uuid::uuid4()->toString(),
        //     'name' => $request->input('name'), 
        //     'email' => $request->input('email'), 
        //     'birth_date' => $request->input('birth_date'), 
        //     'document' => $request->input('document'), 
        //     'cellphone' => $request->input('cellphone'), 
        //     'password' => password_hash($request->input('password'), PASSWORD_BCRYPT), 
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        
        // if($user){
        //     return true;
        // }
        // return false;

        return 'token';
    }

}