<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AdminTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $this->call(AdminLangTableSeeder::class);
        $this->call(AdminCountryTableSeeder::class);
        $this->call(AdminTerritorialArea1TableSeeder::class);
        $this->call(AdminTerritorialArea2TableSeeder::class);
        $this->call(AdminActionTableSeeder::class);
        $this->call(AdminPackageTableSeeder::class);
        $this->call(AdminProfileTableSeeder::class);
        $this->call(AdminResourceTableSeeder::class);
        $this->call(AdminUserTableSeeder::class);
        $this->call(AdminPermissionTableSeeder::class);

        Model::reguard();
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminTableSeeder"
 */