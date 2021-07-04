<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Product;
use JWTAuth;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
    * @test
    */
    public function test_home_screen_can_be_rendered()
    {
        $response = $this->get(route('api.products.home'));

        $response->assertStatus(200);
    }

    /**
    * @test
    */
    public function test_can_list_products() {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $products = Product::factory()->count(5)->create();

        $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
            'Content-Type' => 'application/json', 
            'Accept' => 'application/json'
        ])
            ->json('GET', route('api.products'))
            ->assertStatus(200);
    }
    
    /**
    * @test
    */
    public function test_can_create_product()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $product = Product::factory()->create();

        $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
            'Content-Type' => 'application/json', 
            'Accept' => 'application/json'
        ])
            ->json('POST', route('api.products.store'), $product->toArray())
            ->assertStatus(201);
    }

    /**
    * @test
    */
    public function test_can_update_product()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $product = Product::factory()->create();

        $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
            'Content-Type' => 'application/json', 
            'Accept' => 'application/json'
        ])
            ->json('PUT', route('api.products.update', ['product' => $product]), $product->toArray())
            ->assertStatus(201);
    }

    /**
    * @test
    */
    public function test_can_show_product()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
            'Content-Type' => 'application/json', 
            'Accept' => 'application/json'
        ])
            ->json('GET', route('api.products.show', ['product' => 10]))
            ->assertStatus(200);
    }

    /**
    * @test
    */
    public function test_can_delete_product()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
            'Content-Type' => 'application/json', 
            'Accept' => 'application/json'
        ])
            ->json('DELETE', route('api.products.delete', ['product' => 21]))
            ->assertStatus(204);
    }

    /**
    * @test
    */
    public function test_can_upload_product()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $file = Storage::get('/app/products/products.json');

        $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
            'Content-Type' => 'application/json', 
            'Accept' => 'application/json'
        ])
            ->json('POST', route('api.jsonUpload', $file))
            ->assertStatus(200);
    }
}
