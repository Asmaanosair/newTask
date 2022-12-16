<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FolderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStoreSuccess()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $Data = [
            "name" => "Test student",
            "user_id" => User::factory(),
        ];

        $this->json('POST', 'api/folder', $Data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "user" => [
                    'id',
                    'name',
                ],

            ]);
    }

}
