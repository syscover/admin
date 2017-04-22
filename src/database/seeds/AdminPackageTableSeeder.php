<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\Package;

class AdminPackageTableSeeder extends Seeder
{
    public function run()
    {
        Package::insert([
            ['id' => '1',   'name' => 'Pulsar',                         'root' => '',             'sort' => 1,     'active' => '1'],
            ['id' => '2',   'name' => 'Pulsar Administration Package',  'root' => 'admin',        'sort' => 2,     'active' => '1'],
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminPackageTableSeeder"
 */