<?php

namespace Tests\Feature;

use App\Models\Router;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoutersTest extends TestCase
{
    /** @test */
    public function user_can_fetch_routers_by_filter()
    {
        $user = User::first();
        $token = JWTAuth::fromUser($user);

        $attributes = [
            "limit" => 5,
            "order" => "asc",
            "page"  => 1,
            "sort"  => "Hostname",
        ];

        $this->postJson('api/router/filter', $attributes, ['authentication' => "bearer $token"])
            ->assertStatus(200);
    }

    /** @test */
    public function user_can_fetch_all_routers()
    {
        $user = User::first();
        $token = JWTAuth::fromUser($user);

        $this->getJson('api/router', [], ['authentication' => "bearer $token"])
            ->assertStatus(200);
    }

    /** @test */
    public function user_can_create_router(): void
    {
        $user = User::first();
        $token = JWTAuth::fromUser($user);

        $attributes = [
            'sap_id'        => $this->faker->unique()->numberBetween($min = 1000, $max = 1000000000),
            'hostname'      => $this->faker->unique()->domainName,
            'loopback'      => $this->faker->unique()->ipv4,
            'mac_address'   => $this->faker->unique()->macAddress,
        ];

        $this->postJson('api/router', $attributes, ['authentication' => "bearer $token"])
            ->assertStatus(201);
    }

    /** @test */
    public function user_can_edit_router(): void
    {
        $user = User::first();
        $token = JWTAuth::fromUser($user);

        $router = Router::first();

        $attributes = [
            'sap_id'        => $this->faker->unique()->numberBetween($min = 1000, $max = 1000000000),
            'hostname'      => $this->faker->unique()->domainName,
            'loopback'      => $this->faker->unique()->ipv4,
            'mac_address'   => $this->faker->unique()->macAddress,
        ];

        $this->putJson('api/router/'.$router->id, $attributes, ['authentication' => "bearer $token"])
             ->assertStatus(200);
    }

    /** @test */
    public function user_can_delete_router_by_id(): void
    {
        $user = User::first();
        $token = JWTAuth::fromUser($user);

        $router = Router::first();

        $this->deleteJson('api/router/'.$router->id, [], ['authentication' => "bearer $token"])
            ->assertStatus(200);

    }

    /** @test */
    public function user_can_delete_router_by_loopback(): void
    {
        $user = User::first();
        $token = JWTAuth::fromUser($user);

        $router = Router::first();

        $this->deleteJson('api/router/update/'.$router->loopback, [], ['authentication' => "bearer $token"])
            ->assertStatus(200);

    }

}
