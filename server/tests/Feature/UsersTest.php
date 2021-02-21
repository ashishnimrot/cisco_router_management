<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use JWTAuth;

class UsersTest extends TestCase
{
    /** @test */
    public function user_can_edit_his_profile(): void
    {
        $user = User::first();

        $token = JWTAuth::fromUser($user);

        $attributes = ['name' => $this->faker->name];

        $this->postJson('api/profile', $attributes, ['authentication' => "bearer $token"])
            ->assertStatus(200);

    }
}
