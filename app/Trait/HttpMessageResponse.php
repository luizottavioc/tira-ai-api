<?php

declare(strict_types=1);

namespace App\Trait;

trait HttpMessageResponse
{
    public function buildResponseMessage(string $message, array $data = []): array
    {
        return [ 'message' => $message, 'data' => $data ];
    }

    public function buildErrorMessage(string $message, array $errors = []): array
    {
        return [ 'message' => $message, 'errors' => $errors ];
    }
}