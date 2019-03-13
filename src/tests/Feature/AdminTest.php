<?php namespace Tests\Feature;

use Tests\TestCase;
use Syscover\Admin\Models\Package;

class AdminTest extends TestCase
{
    // Actions
    public function testGetActions(): void
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
    public function testGetPackages(): void
    {
        $response = $this->json('GET', route('api.admin_package'));

        $response
            ->assertStatus(200)
            ->assertJson([
                'status'        => 200,
                'statusText'    => 'success'
            ]);
    }

    public function testStorePackage(): void
    {
        $response = $this->json('POST', route('api.admin_package'), [
            'name'      => 'Unit Testing',
            'root'      => 'test',
            'version'   => '1.0.0',
            'active'    => true,
            'sort'      => 1
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'status'        => 201,
                'statusText'    => 'success'
            ]);
    }

    public function tearDown(): void
    {
        Package::where('name', 'Unit Testing')->delete();
        parent::tearDown();
    }
}
