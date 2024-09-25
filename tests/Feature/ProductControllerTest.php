<?php

use Tests\TestCase;

class ProductControllerTest extends TestCase
{


    protected $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->product = \App\Models\Product::factory()->create();
    }

    public function testStoreProduct()
    {
        $response = $this->withoutMiddleware()->post(route('product.store'), [
            'name' => 'New Product Name',
            'desc' => 'New Product Description',
            'price' => 199,
            'status' => 'No',
        ]);

        $response->assertRedirect(route('product.index'));
        $this->assertDatabaseHas('products', [
            'name' => 'New Product Name',
            'desc' => 'New Product Description',
            'price' => 199,
            'status' => 'No',
        ]);
    }

    public function testUpdateProduct()
    {
        $response = $this->withoutMiddleware()->put(route('product.update', $this->product->id), [
            'name' => 'Updated Product Name',
            'desc' => 'Updated Product Description',
            'price' => 299,
            'status' => 'No',
        ]);

        $response->assertRedirect(route('product.index'));
        $this->assertDatabaseHas('products', [
            'id' => $this->product->id,
            'name' => 'Updated Product Name',
            'desc' => 'Updated Product Description',
            'price' => 299,
            'status' => 'No',
        ]);
    }

    public function testDeleteProduct()
    {
        $response = $this->withoutMiddleware()->delete(route('product.delete', $this->product->id));
        $response->assertRedirect(route('product.index'));

    }
}
