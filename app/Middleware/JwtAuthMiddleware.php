<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function Hyperf\Support\env;

class JwtAuthMiddleware implements MiddlewareInterface
{
    private string $jwtSecretKey;

    public function __construct(
        private ContainerInterface $container
    )
    {
        $this->jwtSecretKey = env('JWT_SECRET_KEY', 'secret');
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $handler->handle($request);
    }
}
