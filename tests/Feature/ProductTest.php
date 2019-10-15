<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    /*
     * CREATE-1
     * */
    public function test_client_can_create_a_product()
    {
        $productData = [
            'name' => 'Super Product',
            'price' => '23.30'
        ];
        $response = $this->json('POST', '/api/products', $productData);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'name',
            'price'
        ]);
        $response->assertJsonFragment([
            'name' => 'Super Product',
            'price' => '23.30'
        ]);
        $body = $response->decodeResponseJson();
        $this->assertDatabaseHas(
            'products',
            [
                'id' => $body['id'],
                'name' => 'Super Product',
                'price' => '23.30'
            ]
        );
    }

    /*
     * CREATE-2
     * */
    public function test_create_product_without_name()
    {
        $productData = [
            'price' => '23.30'
        ];

        $response = $this->json('POST', '/api/products', $productData);
        $response->assertStatus(422);

        $response->assertJson([
            'errors' => [[
                'code' => 'ERROR-1',
                'title' => 'Unprocessable Entity'
            ]]
        ]);
    }

    /*
     * CREATE-3
     * */
    public function test_create_product_without_price()
    {
        $productData = [
            'name' => 'Super Product'
        ];

        $response = $this->json('POST', '/api/products', $productData);
        $response->assertStatus(422);

        $response->assertJson([
            'errors' => [[
                'code' => 'ERROR-1',
                'title' => 'Unprocessable Entity'
            ]]
        ]);
    }

    /*
     * CREATE-4
     * */
    public function test_create_product_with_price_not_number()
    {
        $productData = [
            'name' => 'Super Product', 'price' => 'Super Product'
        ];

        $response = $this->json('POST', '/api/products', $productData);
        $response->assertStatus(422);

        $response->assertJson([
            'errors' => [[
                'code' => 'ERROR-1',
                'title' => 'Unprocessable Entity'
            ]]
        ]);
    }

    /*
     * CREATE-5
     * */
    public function test_create_product_with_price_less_than_zero()
    {
        $productData = [
            'name' => 'Super Product', 'price' => '-2'
        ];

        $response = $this->json('POST', '/api/products', $productData);
        $response->assertStatus(422);

        $response->assertJson([
            'errors' => [[
                'code' => 'ERROR-1',
                'title' => 'Unprocessable Entity'
            ]]
        ]);
    }

    /*
     * UPDATE-1
     * */
    public function test_edit_product_success()
    {
        $product = factory(Product::class)->create([
            'id' => 1,
            'name' => 'Super product',
            'price' => '23.30',
        ]);

        $productData = [
            'name' => 'Super product 2',
            'price' => '23.50'
        ];

        $response = $this->put(route('products.update', $product->id), $productData);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Super product 2',
                'price' => '23.50',
            ]);

    }

    /*
     * UPDATE-2
     * */
    public function test_edit_product_price_is_not_number()
    {
        $product = factory(Product::class)->create([
            'id' => 1,
            'name' => 'Super product',
            'price' => '23.30',
        ]);

        $productData = [
            'name' => 'Super product 2',
            'price' => 'Hola'
        ];

        $response = $this->put(route('products.update', $product->id), $productData);

        $response->assertStatus(422)
            ->assertJsonFragment([
                'code' => 'ERROR-1',
                'title' => 'Unprocessable Entity',
            ]);

    }

    /*
     * UPDATE-3
     * */
    public function test_edit_product_price_is_less_than_zero()
    {
        $product = factory(Product::class)->create([
            'id' => 1,
            'name' => 'Super product',
            'price' => '23.30',
        ]);

        $productData = [
            'name' => 'Super product 2',
            'price' => '-20'
        ];

        $response = $this->put(route('products.update', $product->id), $productData);

        $response->assertStatus(422)
            ->assertJsonFragment([
                'code' => 'ERROR-1',
                'title' => 'Unprocessable Entity',
            ]);

    }

    /*
     * UPDATE-4
     * */
    public function test_edit_product_not_exist()
    {
        $id = 1;
        $productData = [
            'name' => 'Super product 2',
            'price' => '-20'
        ];

        $response = $this->put(route('products.update', $id), $productData);

        $response->assertStatus(404)
            ->assertJsonFragment([
                'code' => 'ERROR-2',
                'title' => 'Not Found',
            ]);

    }

    /*
     * SHOW-1
     */
    public function test_show_product_success()
    {
        $product = factory(Product::class)->create([
            'id' => 1,
            'name' => 'Super product',
            'price' => '23.30',
        ]);

        $response = $this->json('GET', '/api/products/1');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Super product',
                'price' => '23.30',
            ]);

    }

    /*
     * SHOW-2
     */
    public function test_show_product_not_exist()
    {
        $response = $this->json('GET', '/api/products/1');

        $response->assertStatus(404)
            ->assertJsonFragment([
                'code' => 'ERROR-2',
                'title' => 'Not Found',
            ]);

    }

    /*
     * DELETE-1
     */
    public function test_delete_product_success()
    {
        $product = factory(Product::class)->create([
            'id' => 1,
            'name' => 'Super product',
            'price' => '23.30',
        ]);

        //$response = $this->json('GET', '/api/products/1');
        $response = $this->delete(route('products.destroy', 1));

        $response->assertStatus(204);

    }

    /*
     * DELETE-2
     */
    public function test_delete_product_not_exist()
    {
        $response = $this->delete(route('products.destroy', 1));

        $response->assertStatus(404)
            ->assertJsonFragment([
                'code' => 'ERROR-2',
                'title' => 'Not Found',
            ]);

    }

    /*
     * LIST-1
     */
    public function test_list_two_products()
    {
        factory(Product::class)->create([
            'name' => 'Super product 1',
            'price' => '23.30',
        ]);

        factory(Product::class)->create([
            'name' => 'Super product 2',
            'price' => '23.30',
        ]);

        $response = $this->json('GET', '/api/products');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'Super product 1',
                'price' => '23.30',
            ])
            ->assertJsonFragment([
                'name' => 'Super product 2',
                'price' => '23.30',
            ]);

    }

    /*
     * LIST-2
     */
    public function test_list_with_no_products()
    {
        $response = $this->json('GET', '/api/products');
        $response->assertStatus(200);
    }




}
