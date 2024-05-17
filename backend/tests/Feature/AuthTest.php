<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_register(): void
    {
        $payload = User::factory()->make()->toArray();
        $payload['password'] = $payload['password_confirmation'] = "password";

        $response = $this->post(route('auth.register'), $payload);

        $response->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'name' => $payload['name'],
            'email' => $payload['email'],
        ]);
    }

    public function test_login(): void
    {
        $payload = User::where('email', 'like', '%@example%')->first();

        $response = $this->post(route('auth.login'), [
            'email' => $payload['email'],
            'password' => 'password'
        ]);

        $response->assertSuccessful()
            ->assertJsonPath('success', 'login.authorized')
            ->assertJsonStructure([
                'token'
            ]);
    }
}
