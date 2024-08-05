<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_update_details()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/user-details', [
            'national_id' => '1234567890',
            'street' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'State',
            'postal_code' => '12345',
            'country' => 'Country',
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'User details updated successfully']);

        $this->assertDatabaseHas('user_details', [
            'user_id' => $user->id,
            'national_id' => '1234567890',
        ]);

        $this->assertDatabaseHas('addresses', [
            'user_id' => $user->id,
            'street' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'State',
            'postal_code' => '12345',
            'country' => 'Country',
        ]);
    }

    public function test_unauthenticated_user_cannot_update_details()
    {
        $response = $this->postJson('/api/user-details', [
            'national_id' => '1234567890',
            'street' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'State',
            'postal_code' => '12345',
            'country' => 'Country',
        ]);

        $response->assertStatus(401);
    }
}