<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\Permission;

class AdminPermissionTableSeeder extends Seeder {

    public function run()
    {
        Permission::insert([
            ['profile_id' => '1','resource_id' => 'admin','action_id' => 'access'],
            ['profile_id' => '1','resource_id' => 'admin-country','action_id' => 'access'],
            ['profile_id' => '1','resource_id' => 'admin-country-at1','action_id' => 'access'],
            ['profile_id' => '1','resource_id' => 'admin-country-at2','action_id' => 'access'],
            ['profile_id' => '1','resource_id' => 'admin-country-at3','action_id' => 'access'],
            ['profile_id' => '1','resource_id' => 'admin-cron','action_id' => 'access'],
            ['profile_id' => '1','resource_id' => 'admin-google-services','action_id' => 'access'],
            ['profile_id' => '1','resource_id' => 'admin-lang','action_id' => 'access'],
            ['profile_id' => '1','resource_id' => 'admin-package','action_id' => 'access'],
            ['profile_id' => '1','resource_id' => 'admin-perm','action_id' => 'access'],
            ['profile_id' => '1','resource_id' => 'admin-perm-action','action_id' => 'access'],
            ['profile_id' => '1','resource_id' => 'admin-perm-perm','action_id' => 'access'],
            ['profile_id' => '1','resource_id' => 'admin-perm-profile','action_id' => 'access'],
            ['profile_id' => '1','resource_id' => 'admin-perm-resource','action_id' => 'access'],
            ['profile_id' => '1','resource_id' => 'admin-user','action_id' => 'access'],
            ['profile_id' => '1','resource_id' => 'dh2','action_id' => 'access'],
            ['profile_id' => '1','resource_id' => 'admin','action_id' => 'create'],
            ['profile_id' => '1','resource_id' => 'admin-country','action_id' => 'create'],
            ['profile_id' => '1','resource_id' => 'admin-country-at1','action_id' => 'create'],
            ['profile_id' => '1','resource_id' => 'admin-country-at2','action_id' => 'create'],
            ['profile_id' => '1','resource_id' => 'admin-country-at3','action_id' => 'create'],
            ['profile_id' => '1','resource_id' => 'admin-cron','action_id' => 'create'],
            ['profile_id' => '1','resource_id' => 'admin-google-services','action_id' => 'create'],
            ['profile_id' => '1','resource_id' => 'admin-lang','action_id' => 'create'],
            ['profile_id' => '1','resource_id' => 'admin-package','action_id' => 'create'],
            ['profile_id' => '1','resource_id' => 'admin-perm','action_id' => 'create'],
            ['profile_id' => '1','resource_id' => 'admin-perm-action','action_id' => 'create'],
            ['profile_id' => '1','resource_id' => 'admin-perm-perm','action_id' => 'create'],
            ['profile_id' => '1','resource_id' => 'admin-perm-profile','action_id' => 'create'],
            ['profile_id' => '1','resource_id' => 'admin-perm-resource','action_id' => 'create'],
            ['profile_id' => '1','resource_id' => 'admin-user','action_id' => 'create'],
            ['profile_id' => '1','resource_id' => 'dh2','action_id' => 'create'],
            ['profile_id' => '1','resource_id' => 'admin','action_id' => 'delete'],
            ['profile_id' => '1','resource_id' => 'admin-country','action_id' => 'delete'],
            ['profile_id' => '1','resource_id' => 'admin-country-at1','action_id' => 'delete'],
            ['profile_id' => '1','resource_id' => 'admin-country-at2','action_id' => 'delete'],
            ['profile_id' => '1','resource_id' => 'admin-country-at3','action_id' => 'delete'],
            ['profile_id' => '1','resource_id' => 'admin-cron','action_id' => 'delete'],
            ['profile_id' => '1','resource_id' => 'admin-google-services','action_id' => 'delete'],
            ['profile_id' => '1','resource_id' => 'admin-lang','action_id' => 'delete'],
            ['profile_id' => '1','resource_id' => 'admin-package','action_id' => 'delete'],
            ['profile_id' => '1','resource_id' => 'admin-perm','action_id' => 'delete'],
            ['profile_id' => '1','resource_id' => 'admin-perm-action','action_id' => 'delete'],
            ['profile_id' => '1','resource_id' => 'admin-perm-perm','action_id' => 'delete'],
            ['profile_id' => '1','resource_id' => 'admin-perm-profile','action_id' => 'delete'],
            ['profile_id' => '1','resource_id' => 'admin-perm-resource','action_id' => 'delete'],
            ['profile_id' => '1','resource_id' => 'admin-user','action_id' => 'delete'],
            ['profile_id' => '1','resource_id' => 'dh2','action_id' => 'delete'],
            ['profile_id' => '1','resource_id' => 'admin','action_id' => 'edit'],
            ['profile_id' => '1','resource_id' => 'admin-country','action_id' => 'edit'],
            ['profile_id' => '1','resource_id' => 'admin-country-at1','action_id' => 'edit'],
            ['profile_id' => '1','resource_id' => 'admin-country-at2','action_id' => 'edit'],
            ['profile_id' => '1','resource_id' => 'admin-country-at3','action_id' => 'edit'],
            ['profile_id' => '1','resource_id' => 'admin-cron','action_id' => 'edit'],
            ['profile_id' => '1','resource_id' => 'admin-google-services','action_id' => 'edit'],
            ['profile_id' => '1','resource_id' => 'admin-lang','action_id' => 'edit'],
            ['profile_id' => '1','resource_id' => 'admin-package','action_id' => 'edit'],
            ['profile_id' => '1','resource_id' => 'admin-perm','action_id' => 'edit'],
            ['profile_id' => '1','resource_id' => 'admin-perm-action','action_id' => 'edit'],
            ['profile_id' => '1','resource_id' => 'admin-perm-perm','action_id' => 'edit'],
            ['profile_id' => '1','resource_id' => 'admin-perm-profile','action_id' => 'edit'],
            ['profile_id' => '1','resource_id' => 'admin-perm-resource','action_id' => 'edit'],
            ['profile_id' => '1','resource_id' => 'admin-user','action_id' => 'edit'],
            ['profile_id' => '1','resource_id' => 'dh2','action_id' => 'edit'],
            ['profile_id' => '1','resource_id' => 'admin','action_id' => 'show'],
            ['profile_id' => '1','resource_id' => 'admin-country','action_id' => 'show'],
            ['profile_id' => '1','resource_id' => 'admin-country-at1','action_id' => 'show'],
            ['profile_id' => '1','resource_id' => 'admin-country-at2','action_id' => 'show'],
            ['profile_id' => '1','resource_id' => 'admin-country-at3','action_id' => 'show'],
            ['profile_id' => '1','resource_id' => 'admin-cron','action_id' => 'show'],
            ['profile_id' => '1','resource_id' => 'admin-google-services','action_id' => 'show'],
            ['profile_id' => '1','resource_id' => 'admin-lang','action_id' => 'show'],
            ['profile_id' => '1','resource_id' => 'admin-package','action_id' => 'show'],
            ['profile_id' => '1','resource_id' => 'admin-perm','action_id' => 'show'],
            ['profile_id' => '1','resource_id' => 'admin-perm-action','action_id' => 'show'],
            ['profile_id' => '1','resource_id' => 'admin-perm-perm','action_id' => 'show'],
            ['profile_id' => '1','resource_id' => 'admin-perm-profile','action_id' => 'show'],
            ['profile_id' => '1','resource_id' => 'admin-perm-resource','action_id' => 'show'],
            ['profile_id' => '1','resource_id' => 'admin-user','action_id' => 'show'],
            ['profile_id' => '1','resource_id' => 'dh2','action_id' => 'show']
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminPermissionTableSeeder"
 */