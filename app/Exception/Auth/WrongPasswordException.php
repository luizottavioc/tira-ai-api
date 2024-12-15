<?php

declare(strict_types=1);

namespace App\Exception\Auth;

use Exception;

class WrongPasswordException extends Exception
{
    protected $message = 'Wrong password';
    protected $code = 401;
}