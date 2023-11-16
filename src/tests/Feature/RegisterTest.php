<?php

namespace Tests\Feature;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function testRegistersSuccessfully(): void
    {
        $payload = [
            'name' => 'John',
            'email' => 'john@dummy.com',
            'password' => 'dummy123',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'token',
            ]);
    }

    public function testRequiresPasswordEmailAndName(): void
    {
        $this->json('post', '/api/register')
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ],
            ]);
    }
}
