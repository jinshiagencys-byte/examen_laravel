<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_authentication_basics(): void
    {
        $user = User::factory()->admin()->create();

        $this->actingAs($user);

        $response = $this->get('/api/user');
        $response->assertStatus(200)->assertJsonFragment(['email' => $user->email]);
    }
}
