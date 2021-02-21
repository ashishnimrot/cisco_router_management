<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /** @test */
    public function user_can_register_by_name_email_password() : void
    {
        $email = $this->faker->email;
        if(User::find(['email' => $email]))
            $this->assertTrue(true);


        $response = $this->postJson('/api/auth/register', [
            'email' => $this->faker->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'name' => $this->faker->name,
        ]);

        $response->assertStatus(201);
    }
}
