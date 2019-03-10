<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\Package;

class AdminPackageSeeder extends Seeder
{
    public function run()
    {
        Package::insert([
            ['id' => 1,   'name' => 'Application',      'root' => 'app',            'sort' => 1,        'active' => true,       'version' => '1.0.0'],
            ['id' => 2,   'name' => 'Dashboard',        'root' => 'dashboard',      'sort' => 2,        'active' => true,       'version' => '1.0.0'],
            ['id' => 20,  'name' => 'Admin Package',    'root' => 'admin',          'sort' => 20,       'active' => true,       'version' => '1.0.0'],
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminPackageSeeder"
 */
