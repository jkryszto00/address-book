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

    public function test_address_create()
    {
        $user = User::find(3);

        $data = [
            'number' => '4',
            'street' => 'Nowa',
            'city' => 'Przyłęki',
            'zip' => '86-005'
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

    public function test_address_show()
    {
        $user = User::find(3);

        $data = [
            'number' => '4',
            'street' => 'Nowa',
            'city' => 'Przyłęki',
            'zip' => '86-005'
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

    public function test_address_update()
    {
        $user = User::find(3);

        $data = [
            'number' => '4',
            'street' => 'Nowa',
            'city' => 'Przyłęki',
            'zip' => '86-005'
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

    public function test_address_delete()
    {
        $user = User::find(3);

        $data = [
            'number' => '4',
            'street' => 'Nowa',
            'city' => 'Przyłęki',
            'zip' => '86-005'
        ];

        $address = $this->actingAs($user)->post('/api/addresses', $data);

        $response = $this->actingAs($user)->delete('/api/addresses/'.$address['id']);
        $response->assertNoContent();
    }
}
