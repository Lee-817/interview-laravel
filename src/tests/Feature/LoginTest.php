<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testRequiresEmailAndLogin(): void
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ],
            ]);
    }

    public function testUserLoginsSuccessfully(): void
    {
        User::factory()->create([
            'email' => 'testlogin@dummy.com',
            'password' => 'abcdefg',
        ]);

        $payload = ['email' => 'testlogin@dummy.com', 'password' => 'abcdefg'];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'token',
            ]);
    }
}
