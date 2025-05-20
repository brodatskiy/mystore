<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use Tests\TestCase;

class CartTest extends TestCase
{

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/cart');

        $response->assertStatus(200);
    }
}
