<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSuccessfulLogin()
    {
        User::factory()->create([
            'name' => 'TestUser',
            'email' => 'test@example.com',
            'password'=>Hash::make('12345678')
        ]);

        $loginData = ['email' => 'test@example.com', 'password' => '12345678'];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "user" => [
                    'id',
                    'name',
                    'email',
                    'email_verified_at',
                    'created_at',
                    'updated_at',
                ],
                "access_token",
                "message"
            ]);
        $this->assertAuthenticated();
    }
}
