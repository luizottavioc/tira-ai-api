<?php

declare(strict_types=1);

use App\Request\Interface\LoginRequestInterface;
use App\Request\Interface\UserRegisterRequestInterface;
use App\Service\Interface\AuthServiceInterface;

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    AuthServiceInterface::class => App\Service\AuthService::class, 
    LoginRequestInterface::class => App\Request\LoginRequest::class,
    UserRegisterRequestInterface::class => App\Request\UserRegisterRequest::class,
];
