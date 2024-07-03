<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker; // will be used for faking the data
use Tests\TestCase;

class ProductCategoryTest extends TestCase
{
    /**
     * Product Api test.
     *
     * @return void
     */
    /** @test */
    public function test_create_product()
    {
        $response = $this->postJson('/api/products', [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 10,
            'stock' => 2
        ]);

        $response->assertStatus(201);

        // Checking the response structure and content
        $response->assertJsonStructure([
            'id',
            'name',
            'description',
            'price',
            'stock',
            'created_at',
            'updated_at'
        ])->assertJson([
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 10,
            'stock' => 2
        ]);

        // Checking the database to ensure the product was created
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 10,
            'stock' => 2
        ]);
    }
}
