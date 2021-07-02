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
    /* public function test_can_list_products() {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $products = Product::factory()->count(5)->make();

        $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
            'Content-Type' => 'application/json', 
            'Accept' => 'application/json'
        ])
            ->json('GET', route('api.products'))
            ->assertStatus(200);
    } */
    
    /**
    * @test
    */
    /* public function test_can_create_product()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $product = Product::factory()->make();

        $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
            'Content-Type' => 'application/json', 
            'Accept' => 'application/json'
        ])
            ->json('POST', route('api.products.store'), $product->toArray())
            ->assertStatus(201)
            ->assertJson(["data" => $product->toArray()]);
    } */

    /**
    * @test
    */
    public function test_can_update_product()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $product = Product::factory()->make();
        $product->title = "My Title";

        $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
            'Content-Type' => 'application/json', 
            'Accept' => 'application/json'
        ])
            ->json('PUT', route('api.products.update', ['product' => $product->id]), $product->toArray())
            ->assertStatus(201);
    }

    /**
    * @test
    */
    /* public function test_can_show_product()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $product = Product::factory()->make();

        $this->get(route('api.products.show', ['product' => $product]))
            ->assertStatus(201);
    } */
}
