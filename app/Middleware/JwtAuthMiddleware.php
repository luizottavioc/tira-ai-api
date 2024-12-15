<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Service\AuthService;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use App\Trait\HttpMessageResponse;
use Hyperf\Di\Container;

class JwtAuthMiddleware implements MiddlewareInterface
{
    use HttpMessageResponse;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var HttpResponse
     */
    protected $response;

    protected string $jwtSecretKey;

    public function __construct(Container $container, HttpResponse $response, RequestInterface $request)
    {
        $this->container = $container;
        $this->response = $response;
        $this->request = $request;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $authorization = $this->request->getHeader('Authorization');

        if (empty($authorization)) {
            $responseObject = $this->buildResponseMessage('Token not found');
            return $this->response->json($responseObject)->withStatus(401);
        }

        try {
            $token = explode(' ', $authorization[0])[1];
            $decodedToken = AuthService::decodeToken($token);
            $this->container->set('user', $decodedToken);
        } catch (\Exception $e) {
            $responseError = $this->buildResponseMessage('Invalid token');
            return $this->response->json($responseError)->withStatus(401);
        }

        return $handler->handle($request);
    }
}
