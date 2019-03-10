<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AdminTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $this->call(AdminLangSeeder::class);
        $this->call(AdminCountrySeeder::class);
        $this->call(AdminTerritorialArea1Seeder::class);
        $this->call(AdminTerritorialArea2Seeder::class);
        $this->call(AdminActionSeeder::class);
        $this->call(AdminPackageSeeder::class);
        $this->call(AdminProfileSeeder::class);
        $this->call(AdminResourceSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(AdminPermissionSeeder::class);

        Model::reguard();
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminTableSeeder"
 */
