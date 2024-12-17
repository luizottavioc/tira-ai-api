<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;
use App\Middleware\JwtAuthMiddleware;

use App\Controller\AuthController;

Router::addRoute(['GET'], '/ping', function () { return 'pong'; });

Router::addGroup('/auth', function () {
    Router::post('/login', [AuthController::class, 'login']);
    Router::post('/register', [AuthController::class, 'register']);
    Router::get('/me', [AuthController::class, 'me'], [ 'middleware' => [JwtAuthMiddleware::class] ]);
    Router::get('/refresh-token', [AuthController::class, 'refreshToken'], [ 'middleware' => [JwtAuthMiddleware::class] ]);
});