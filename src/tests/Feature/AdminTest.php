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
                'status'        => 200,
                'statusText'    => 'success'
            ]);
    }

    // Packages
    public function testGetPackages()
    {
        $response = $this->json('GET', route('api.admin_package'));

        $response
            ->assertStatus(200)
            ->assertJson([
                'status'        => 200,
                'statusText'    => 'success'
            ]);
    }

    public function testStorePackages()
    {
        $response = $this->json('POST', route('api.admin_package'), [
            'name'      => 'Unit Testing',
            'root'      => 'test',
            'version'   => '1.0.0',
            'active'    => true,
            'sort'      => 1
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status'        => 200,
                'statusText'    => 'success'
            ]);
    }
}
