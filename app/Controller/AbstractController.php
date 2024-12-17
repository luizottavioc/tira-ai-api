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

namespace App\Controller;

use App\Trait\HttpMessageResponse;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as MessageResponseInterface;

abstract class AbstractController 
{
    use HttpMessageResponse;
    
    public function __construct(
        protected ContainerInterface $container,
        protected RequestInterface $request,
        protected ResponseInterface $response
    ) {}

    public function sendResponse(string $message, int $statusCode, array $data = []): MessageResponseInterface
    {
        $responseObject = $this->buildResponseMessage($message, $data);

        return $this->response
            ->json($responseObject)
            ->withStatus($statusCode);
    }

    public function sendError(string $message, int $statusCode, array $errors = []): MessageResponseInterface
    {
        $errorResponseObject = $this->buildErrorMessage($message, $errors);

        return $this->response
            ->json($errorResponseObject)
            ->withStatus($statusCode);
    }
}
