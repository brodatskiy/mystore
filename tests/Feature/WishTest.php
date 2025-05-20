<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class WishTest extends TestCase
{

    public function test_the_application_returns_a_successful_response(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $response = $this->get('/wishes');

        $response->assertStatus(200);
    }
}
