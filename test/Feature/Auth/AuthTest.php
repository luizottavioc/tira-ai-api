<?php

declare(strict_types=1);

namespace Test\Feature\Auth;

use Hyperf\Testing\Client;
use Hyperf\Testing\TestCase;

use function Hyperf\Support\make;

class AuthTest extends TestCase
{
    protected Client $client;

    public function __construct($name = null, array $data = [], $dataName ='')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = make(Client::class);
    }
    
    public function testLoginAdmin(): void
    {
        $response = $this->post('/auth/login', [
            'email' => 'admin@tira.ai',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        
        $resData = $response->json()['data'];
        $this->assertArrayHasKey('token', $resData);
        $this->assertArrayHasKey('user', $resData);
    }
}

