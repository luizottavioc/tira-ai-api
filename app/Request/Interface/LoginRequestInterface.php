<?php

declare(strict_types=1);

namespace App\Request\Interface;

interface LoginRequestInterface
{
    public function getEmail(): string;
    public function getPassword(): string;
}