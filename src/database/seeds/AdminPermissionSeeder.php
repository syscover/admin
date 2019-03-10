<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\Permission;

class AdminPermissionSeeder extends Seeder {

    public function run()
    {
        Permission::insert([

            ['profile_id' => '1',   'resource_id' => 'app',                 'action_id' => 'access'],
            ['profile_id' => '1',   'resource_id' => 'dashboard',           'action_id' => 'access'],
            ['profile_id' => '1',   'resource_id' => 'admin',               'action_id' => 'access'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm',          'action_id' => 'access'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-action',   'action_id' => 'access'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-perm',     'action_id' => 'access'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-profile',  'action_id' => 'access'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-resource', 'action_id' => 'access'],
            ['profile_id' => '1',   'resource_id' => 'admin-user',          'action_id' => 'access'],

            ['profile_id' => '1',   'resource_id' => 'app',                 'action_id' => 'create'],
            ['profile_id' => '1',   'resource_id' => 'dashboard',           'action_id' => 'create'],
            ['profile_id' => '1',   'resource_id' => 'admin',               'action_id' => 'create'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm',          'action_id' => 'create'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-action',   'action_id' => 'create'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-perm',     'action_id' => 'create'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-profile',  'action_id' => 'create'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-resource', 'action_id' => 'create'],
            ['profile_id' => '1',   'resource_id' => 'admin-user',          'action_id' => 'create'],

            ['profile_id' => '1',   'resource_id' => 'app',                 'action_id' => 'delete'],
            ['profile_id' => '1',   'resource_id' => 'dashboard',           'action_id' => 'delete'],
            ['profile_id' => '1',   'resource_id' => 'admin',               'action_id' => 'delete'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm',          'action_id' => 'delete'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-action',   'action_id' => 'delete'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-perm',     'action_id' => 'delete'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-profile',  'action_id' => 'delete'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-resource', 'action_id' => 'delete'],
            ['profile_id' => '1',   'resource_id' => 'admin-user',          'action_id' => 'delete'],

            ['profile_id' => '1',   'resource_id' => 'app',                 'action_id' => 'edit'],
            ['profile_id' => '1',   'resource_id' => 'dashboard',           'action_id' => 'edit'],
            ['profile_id' => '1',   'resource_id' => 'admin',               'action_id' => 'edit'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm',          'action_id' => 'edit'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-action',   'action_id' => 'edit'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-perm',     'action_id' => 'edit'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-profile',  'action_id' => 'edit'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-resource', 'action_id' => 'edit'],
            ['profile_id' => '1',   'resource_id' => 'admin-user',          'action_id' => 'edit'],

            ['profile_id' => '1',   'resource_id' => 'app',                 'action_id' => 'list'],
            ['profile_id' => '1',   'resource_id' => 'dashboard',           'action_id' => 'list'],
            ['profile_id' => '1',   'resource_id' => 'admin',               'action_id' => 'list'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm',          'action_id' => 'list'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-action',   'action_id' => 'list'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-perm',     'action_id' => 'list'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-profile',  'action_id' => 'list'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-resource', 'action_id' => 'list'],
            ['profile_id' => '1',   'resource_id' => 'admin-user',          'action_id' => 'list'],

            ['profile_id' => '1',   'resource_id' => 'app',                 'action_id' => 'show'],
            ['profile_id' => '1',   'resource_id' => 'dashboard',           'action_id' => 'show'],
            ['profile_id' => '1',   'resource_id' => 'admin',               'action_id' => 'show'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm',          'action_id' => 'show'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-action',   'action_id' => 'show'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-perm',     'action_id' => 'show'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-profile',  'action_id' => 'show'],
            ['profile_id' => '1',   'resource_id' => 'admin-perm-resource', 'action_id' => 'show'],
            ['profile_id' => '1',   'resource_id' => 'admin-user',          'action_id' => 'show'],
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminPermissionTableSeeder"
 */
