<?php

namespace Tests\Http\Middleware;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticateApiKeyMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_rejects_requests_without_api_key()
    {
        $response = $this->getJson('/api/users');

        $response->assertStatus(401);
        $response->assertJson(['message' => 'Unauthorized']);
    }

    /** @test */
    public function it_accepts_requests_with_valid_api_key()
    {
        $apiKey = env('API_KEY');

        $response = $this->getJson('/api/users', ['API-KEY' => $apiKey]);

        $response->assertStatus(200);
    }
}
