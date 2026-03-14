<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BMIControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test BMI store route success
     */
    public function test_route_store_success(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/bmi/store', ['height' => 1.7, 'weight' => 70]);
        $response->assertRedirect(route('bmi.index'));
    }
}
