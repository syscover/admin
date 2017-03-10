<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\Profile;

class AdminProfileTableSeeder extends Seeder
{
    public function run()
    {
        Profile::insert([
            ['id' => '1','name' => 'Administrador'],
            ['id' => '2','name' => 'Supervisor'],
            ['id' => '3','name' => 'Usuario'],
            ['id' => '4','name' => 'Visor'],
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminProfileTableSeeder"
 */