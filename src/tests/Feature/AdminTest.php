<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminTest extends TestCase
{
    // Actions
    public function testGetActions()
    {
        $response = $this->json('GET', route('api.admin_action'));

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 200,
                'statusText' => 'success'
            ]);
    }
}
