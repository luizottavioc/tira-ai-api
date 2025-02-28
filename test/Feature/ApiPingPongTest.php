<?php

declare(strict_types=1);

namespace Test\Feature;

use Hyperf\Testing\Client;
use Hyperf\Testing\TestCase;

use function Hyperf\Support\make;

class ApiPingPongTest extends TestCase
{
    protected Client $client;

    public function __construct($name = null, array $data = [], $dataName ='')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = make(Client::class);
    }
    
    public function testPing(): void
    {
        $this->get('/ping')
            ->assertOk()
            ->assertSee('pong');
    }
}

