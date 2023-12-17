<?php

namespace Tests\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_lists_all_active_users()
    {
        User::factory()->count(5)->create(['is_active' => true]);

        $apiKey = env('API_KEY');

        $response = $this->getJson('/api/users', ['API-KEY' => $apiKey]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'email', 'phone']
        ]);
    }

    /** @test */
    public function it_creates_a_new_user()
    {
        $apiKey = env('API_KEY');
        $userData = [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'phone' => '1234567890'
        ];

        $response = $this->postJson('/api/users', $userData, ['API-KEY' => $apiKey]);

        $response->assertStatus(201);
        $response->assertJson([
            'user' => [
                'name' => 'New User',
                'email' => 'newuser@example.com',
                'phone' => '1234567890'
            ]
        ]);
        $this->assertDatabaseHas('users', ['email' => 'newuser@example.com']);
    }

    /** @test */
    public function it_shows_user_details()
    {
        $user = User::factory()->create();
        $apiKey = env('API_KEY');

        $response = $this->getJson("/api/users/$user->id", ['API-KEY' => $apiKey]);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone
        ]);
    }

    /** @test */
    public function it_updates_a_user()
    {
        $user = User::factory()->create();
        $apiKey = env('API_KEY');
        $updateData = ['name' => 'Updated Name'];

        $response = $this->putJson("/api/users/$user->id", $updateData, ['API-KEY' => $apiKey]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name'
        ]);
    }

    /** @test */
    public function it_deletes_a_user()
    {
        $user = User::factory()->create();
        $apiKey = env('API_KEY');

        $response = $this->deleteJson("/api/users/$user->id", [], ['API-KEY' => $apiKey]);

        $response->assertStatus(200);
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }
}
