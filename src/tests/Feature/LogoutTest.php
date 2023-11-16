<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    public function testUserIsLoggedOutProperly(): void
    {
        $user = User::factory()->create(['email' => 'user@test.com']);
        $token = $user->createToken('API TOKEN')->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        $this->json('get', '/api/user', [], $headers)->assertStatus(200);
        $this->json('GET', '/api/logout', [], $headers)->assertStatus(200)->assertJson([
            'status' => true,
            'message' => 'Logged out success.',
        ]);

        $user = User::find($user->id);
        $this->assertEquals(null, $user?->currentAccessToken());
    }

    public function testUserWithNullToken(): void
    {
        $user = User::factory()->create(['email' => 'user@test.com']);
        $token = $user->createToken('API TOKEN')->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        // Revoke the token that was used to authenticate the current request
        $user->tokens()->delete();

        $this->json('get', '/api/logout', [], $headers)->assertStatus(401);
    }
}
