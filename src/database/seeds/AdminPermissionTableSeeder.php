<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\Permission;

class AdminPermissionTableSeeder extends Seeder {

    public function run()
    {
        Permission::insert([
            ['profile_id' => '1','resource_object_id' => 'admin','action_object_id' => 'access'],
            ['profile_id' => '1','resource_object_id' => 'admin-country','action_object_id' => 'access'],
            ['profile_id' => '1','resource_object_id' => 'admin-country-at1','action_object_id' => 'access'],
            ['profile_id' => '1','resource_object_id' => 'admin-country-at2','action_object_id' => 'access'],
            ['profile_id' => '1','resource_object_id' => 'admin-country-at3','action_object_id' => 'access'],
            ['profile_id' => '1','resource_object_id' => 'admin-cron','action_object_id' => 'access'],
            ['profile_id' => '1','resource_object_id' => 'admin-google-services','action_object_id' => 'access'],
            ['profile_id' => '1','resource_object_id' => 'admin-lang','action_object_id' => 'access'],
            ['profile_id' => '1','resource_object_id' => 'admin-package','action_object_id' => 'access'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm','action_object_id' => 'access'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-action','action_object_id' => 'access'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-perm','action_object_id' => 'access'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-profile','action_object_id' => 'access'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-resource','action_object_id' => 'access'],
            ['profile_id' => '1','resource_object_id' => 'admin-user','action_object_id' => 'access'],
            ['profile_id' => '1','resource_object_id' => 'pulsar','action_object_id' => 'access'],
            ['profile_id' => '1','resource_object_id' => 'admin','action_object_id' => 'create'],
            ['profile_id' => '1','resource_object_id' => 'admin-country','action_object_id' => 'create'],
            ['profile_id' => '1','resource_object_id' => 'admin-country-at1','action_object_id' => 'create'],
            ['profile_id' => '1','resource_object_id' => 'admin-country-at2','action_object_id' => 'create'],
            ['profile_id' => '1','resource_object_id' => 'admin-country-at3','action_object_id' => 'create'],
            ['profile_id' => '1','resource_object_id' => 'admin-cron','action_object_id' => 'create'],
            ['profile_id' => '1','resource_object_id' => 'admin-google-services','action_object_id' => 'create'],
            ['profile_id' => '1','resource_object_id' => 'admin-lang','action_object_id' => 'create'],
            ['profile_id' => '1','resource_object_id' => 'admin-package','action_object_id' => 'create'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm','action_object_id' => 'create'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-action','action_object_id' => 'create'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-perm','action_object_id' => 'create'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-profile','action_object_id' => 'create'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-resource','action_object_id' => 'create'],
            ['profile_id' => '1','resource_object_id' => 'admin-user','action_object_id' => 'create'],
            ['profile_id' => '1','resource_object_id' => 'pulsar','action_object_id' => 'create'],
            ['profile_id' => '1','resource_object_id' => 'admin','action_object_id' => 'delete'],
            ['profile_id' => '1','resource_object_id' => 'admin-country','action_object_id' => 'delete'],
            ['profile_id' => '1','resource_object_id' => 'admin-country-at1','action_object_id' => 'delete'],
            ['profile_id' => '1','resource_object_id' => 'admin-country-at2','action_object_id' => 'delete'],
            ['profile_id' => '1','resource_object_id' => 'admin-country-at3','action_object_id' => 'delete'],
            ['profile_id' => '1','resource_object_id' => 'admin-cron','action_object_id' => 'delete'],
            ['profile_id' => '1','resource_object_id' => 'admin-google-services','action_object_id' => 'delete'],
            ['profile_id' => '1','resource_object_id' => 'admin-lang','action_object_id' => 'delete'],
            ['profile_id' => '1','resource_object_id' => 'admin-package','action_object_id' => 'delete'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm','action_object_id' => 'delete'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-action','action_object_id' => 'delete'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-perm','action_object_id' => 'delete'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-profile','action_object_id' => 'delete'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-resource','action_object_id' => 'delete'],
            ['profile_id' => '1','resource_object_id' => 'admin-user','action_object_id' => 'delete'],
            ['profile_id' => '1','resource_object_id' => 'pulsar','action_object_id' => 'delete'],
            ['profile_id' => '1','resource_object_id' => 'admin','action_object_id' => 'edit'],
            ['profile_id' => '1','resource_object_id' => 'admin-country','action_object_id' => 'edit'],
            ['profile_id' => '1','resource_object_id' => 'admin-country-at1','action_object_id' => 'edit'],
            ['profile_id' => '1','resource_object_id' => 'admin-country-at2','action_object_id' => 'edit'],
            ['profile_id' => '1','resource_object_id' => 'admin-country-at3','action_object_id' => 'edit'],
            ['profile_id' => '1','resource_object_id' => 'admin-cron','action_object_id' => 'edit'],
            ['profile_id' => '1','resource_object_id' => 'admin-google-services','action_object_id' => 'edit'],
            ['profile_id' => '1','resource_object_id' => 'admin-lang','action_object_id' => 'edit'],
            ['profile_id' => '1','resource_object_id' => 'admin-package','action_object_id' => 'edit'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm','action_object_id' => 'edit'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-action','action_object_id' => 'edit'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-perm','action_object_id' => 'edit'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-profile','action_object_id' => 'edit'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-resource','action_object_id' => 'edit'],
            ['profile_id' => '1','resource_object_id' => 'admin-user','action_object_id' => 'edit'],
            ['profile_id' => '1','resource_object_id' => 'pulsar','action_object_id' => 'edit'],
            ['profile_id' => '1','resource_object_id' => 'admin','action_object_id' => 'show'],
            ['profile_id' => '1','resource_object_id' => 'admin-country','action_object_id' => 'show'],
            ['profile_id' => '1','resource_object_id' => 'admin-country-at1','action_object_id' => 'show'],
            ['profile_id' => '1','resource_object_id' => 'admin-country-at2','action_object_id' => 'show'],
            ['profile_id' => '1','resource_object_id' => 'admin-country-at3','action_object_id' => 'show'],
            ['profile_id' => '1','resource_object_id' => 'admin-cron','action_object_id' => 'show'],
            ['profile_id' => '1','resource_object_id' => 'admin-google-services','action_object_id' => 'show'],
            ['profile_id' => '1','resource_object_id' => 'admin-lang','action_object_id' => 'show'],
            ['profile_id' => '1','resource_object_id' => 'admin-package','action_object_id' => 'show'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm','action_object_id' => 'show'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-action','action_object_id' => 'show'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-perm','action_object_id' => 'show'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-profile','action_object_id' => 'show'],
            ['profile_id' => '1','resource_object_id' => 'admin-perm-resource','action_object_id' => 'show'],
            ['profile_id' => '1','resource_object_id' => 'admin-user','action_object_id' => 'show'],
            ['profile_id' => '1','resource_object_id' => 'pulsar','action_object_id' => 'show']
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminPermissionTableSeeder"
 */