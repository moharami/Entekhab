<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use App\Jobs\SendRegistrationEmailJob;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        Queue::fake();

        $response = $this->postJson('/api/register', [
            'name' => 'Amir Moharami',
            'mobile' => '09127468130',
            'email'=>'a.moharami@gmail.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(201)
            ->assertJson(['message' => 'User registered successfully']);

        $this->assertDatabaseHas('users', [
            'name' => 'Amir Moharami',
            'mobile' => '09127468130',
        ]);

        Queue::assertPushed(SendRegistrationEmailJob::class);
    }

    public function test_user_cannot_register_with_existing_mobile_number()
    {
        User::factory()->create(['mobile' => '1234567890']);

        $response = $this->postJson('/api/register', [
            'name' => 'Jane Doe',
            'mobile' => '1234567890',
            'password' => 'password123',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['mobile']);
    }
}