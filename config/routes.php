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
use App\Middleware\JwtAuthMiddleware;
use Hyperf\HttpServer\Router\Router;

use App\Controller\AuthController;

Router::addRoute(['GET'], '/hello-world', function () { return 'Hello World'; }, ['middleware' => [JwtAuthMiddleware::class]]);

Router::addGroup('/auth', function () {
    Router::post('/login', [AuthController::class, 'login']);
    Router::post('/register', [AuthController::class, 'register']);
});