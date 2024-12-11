<?php

declare(strict_types=1);

namespace App\Request\Interface;

interface UserRegisterRequestInterface
{
    public function getEmail(): string;
    public function getName(): string;
    public function getCellphone(): string;
    public function getPassword(): string;
}