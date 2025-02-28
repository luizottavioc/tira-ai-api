<?php

declare(strict_types=1);

namespace Test\Feature\Auth;

use Hyperf\Testing\TestCase;

class AuthTest extends TestCase
{   
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

