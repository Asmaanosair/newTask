<?php

namespace Tests\Feature;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoteTest extends TestCase
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
            "type" => "pdf",
            "user_id" => User::factory(),
            "folder_id" => Folder::factory(),
        ];

        $this->json('POST', 'api/note', $Data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "user" => [
                    'id',
                    'name',
                ],

            ]);
    }
}
