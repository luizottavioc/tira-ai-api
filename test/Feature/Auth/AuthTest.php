<?php

declare(strict_types=1);

namespace Test\Feature\Auth;

use Hyperf\Testing\Client;
use Hyperf\Testing\TestCase;

// use PHPUnit\Framework\TestCase;

use function Hyperf\Support\make;

class AuthTest extends TestCase
{
    protected Client $client;

    public function __construct($name = null, array $data = [], $dataName ='')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = make(Client::class);
    }
    
    public function testLogin()
    {
        $this->assertTrue(true);
        $this->get('/ping')->assertOk()->assertSee('pong');
    }
}

