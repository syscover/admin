<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\Lang;

class AdminLangSeeder extends Seeder
{
    public function run()
    {
        Lang::insert([
            ['id' => 1, 'code' => 'de', 'name' => 'Deutsch',  'icon' => 'de', 'sort' => '0', 'active' => '0'],
            ['id' => 2, 'code' => 'en', 'name' => 'English',  'icon' => 'gb', 'sort' => '0', 'active' => '0'],
            ['id' => 3, 'code' => 'es', 'name' => 'Español',  'icon' => 'es', 'sort' => '1', 'active' => '1'],
            ['id' => 4, 'code' => 'fr', 'name' => 'Français', 'icon' => 'fr', 'sort' => '0', 'active' => '0']
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminLangSeeder"
 */
