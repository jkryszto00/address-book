<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    public function test_address_list_as_user()
    {
        $user = User::find(3);

        $response = $this->actingAs($user)->get('/api/addresses');
        $response->assertStatus(200);
    }

    public function test_address_list_as_administrator()
    {
        $user = User::find(2);

        $response = $this->actingAs($user)->get('/api/addresses');
        $response->assertStatus(200);
    }

    public function test_address_create_as_user()
    {
        $user = User::find(3);

        $data = [
            'number' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'zip' => fake()->postcode()
        ];

        $response = $this->actingAs($user)->post('/api/addresses', $data);
        $response->assertJsonStructure([
            'id',
            'number',
            'street',
            'city',
            'zip'
        ]);
    }

    public function test_address_create_as_administrator()
    {
        $user = User::find(2);

        $data = [
            'number' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'zip' => fake()->postcode()
        ];

        $response = $this->actingAs($user)->post('/api/addresses', $data);
        $response->assertJsonStructure([
            'id',
            'number',
            'street',
            'city',
            'zip'
        ]);
    }

    public function test_address_show_own_as_user()
    {
        $user = User::find(3);

        $data = [
            'number' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'zip' => fake()->postcode()
        ];

        $address = $this->actingAs($user)->post('/api/addresses', $data);

        $response = $this->actingAs($user)->get('/api/addresses/'.$address['id']);
        $response->assertJsonStructure([
            'id',
            'number',
            'street',
            'city',
            'zip'
        ]);
    }

    public function test_address_show_own_as_administrator()
    {
        $user = User::find(2);

        $data = [
            'number' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'zip' => fake()->postcode()
        ];

        $address = $this->actingAs($user)->post('/api/addresses', $data);

        $response = $this->actingAs($user)->get('/api/addresses/'.$address['id']);
        $response->assertJsonStructure([
            'id',
            'number',
            'street',
            'city',
            'zip'
        ]);
    }

    public function test_address_show_not_own_as_user()
    {
        $owner = User::find(2);
        $user = User::find(3);

        $data = [
            'number' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'zip' => fake()->postcode()
        ];

        $address = $this->actingAs($owner)->post('/api/addresses', $data);

        $response = $this->actingAs($user)->get('/api/addresses/'.$address['id']);
        $response->assertStatus(403);
    }

    public function test_address_show_not_own_as_administrator()
    {
        $owner = User::find(3);
        $user = User::find(2);

        $data = [
            'number' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'zip' => fake()->postcode()
        ];

        $address = $this->actingAs($owner)->post('/api/addresses', $data);

        $response = $this->actingAs($user)->get('/api/addresses/'.$address['id']);
        $response->assertJsonStructure([
            'id',
            'number',
            'street',
            'city',
            'zip'
        ]);
    }

    public function test_address_update_own_as_user()
    {
        $user = User::find(3);

        $data = [
            'number' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'zip' => fake()->postcode()
        ];

        $address = $this->actingAs($user)->post('/api/addresses', $data);

        $response = $this->actingAs($user)->put('/api/addresses/'.$address['id'], $data);
        $response->assertJsonStructure([
            'id',
            'number',
            'street',
            'city',
            'zip'
        ]);
    }

    public function test_address_update_own_as_administrator()
    {
        $user = User::find(2);

        $data = [
            'number' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'zip' => fake()->postcode()
        ];

        $address = $this->actingAs($user)->post('/api/addresses', $data);

        $response = $this->actingAs($user)->put('/api/addresses/'.$address['id'], $data);
        $response->assertJsonStructure([
            'id',
            'number',
            'street',
            'city',
            'zip'
        ]);
    }

    public function test_address_update_not_own_as_user()
    {
        $own = User::find(2);
        $user = User::find(3);

        $data = [
            'number' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'zip' => fake()->postcode()
        ];

        $address = $this->actingAs($own)->post('/api/addresses', $data);

        $response = $this->actingAs($user)->put('/api/addresses/'.$address['id'], $data);
        $response->assertStatus(403);
    }

    public function test_address_update_not_own_as_administrator()
    {
        $own = User::find(3);
        $user = User::find(2);

        $data = [
            'number' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'zip' => fake()->postcode()
        ];

        $address = $this->actingAs($own)->post('/api/addresses', $data);

        $response = $this->actingAs($user)->put('/api/addresses/'.$address['id'], $data);
        $response->assertJsonStructure([
            'id',
            'number',
            'street',
            'city',
            'zip'
        ]);
    }

    public function test_address_delete_not_own_as_user()
    {
        $owner = User::find(2);
        $user = User::find(3);

        $data = [
            'number' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'zip' => fake()->postcode()
        ];

        $address = $this->actingAs($owner)->post('/api/addresses', $data);
        $response = $this->actingAs($user)->delete('/api/addresses/'.$address['id']);
        $response->assertStatus(403);
    }

    public function test_address_delete_not_own_as_administrator()
    {
        $owner = User::find(3);
        $user = User::find(2);

        $data = [
            'number' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'zip' => fake()->postcode()
        ];

        $address = $this->actingAs($owner)->post('/api/addresses', $data);
        $response = $this->actingAs($user)->delete('/api/addresses/'.$address['id']);
        $response->assertNoContent();
    }

    public function test_address_delete_own_as_administrator()
    {
        $user = User::find(2);

        $data = [
            'number' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'zip' => fake()->postcode()
        ];

        $address = $this->actingAs($user)->post('/api/addresses', $data);
        $response = $this->actingAs($user)->delete('/api/addresses/'.$address['id']);
        $response->assertNoContent();
    }

    public function test_address_delete_own_as_user()
    {
        $user = User::find(3);

        $data = [
            'number' => fake()->buildingNumber(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'zip' => fake()->postcode()
        ];

        $address = $this->actingAs($user)->post('/api/addresses', $data);

        $response = $this->actingAs($user)->delete('/api/addresses/'.$address['id']);
        $response->assertNoContent();
    }
}
