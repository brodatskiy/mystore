<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_page_is_displayed(): void
    {

        $product = Product::factory()->create();

        $response = $this->get('product/' . $product->id);

        $response->assertStatus(200);
    }
}
