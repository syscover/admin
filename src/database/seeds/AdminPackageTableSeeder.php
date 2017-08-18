<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\Package;

class AdminPackageTableSeeder extends Seeder
{
    public function run()
    {
        Package::insert([
            ['id' => 1,   'name' => 'Pulsar',                         'root' => '',             'sort' => 1,        'active' => true],
            ['id' => 20,  'name' => 'Pulsar Administration Package',  'root' => 'admin',        'sort' => 20,       'active' => true],
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminPackageTableSeeder"
 */