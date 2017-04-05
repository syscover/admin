<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\Lang;

class AdminLangTableSeeder extends Seeder
{
    public function run()
    {
        Lang::insert([
            ['id' => 'de',  'name' => 'Deutsch',    'icon' => 'de',    'sort' => '0',   'base' => '0',  'active' => '0'],
            ['id' => 'en',  'name' => 'English',    'icon' => 'gb',    'sort' => '0',   'base' => '0',  'active' => '0'],
            ['id' => 'es',  'name' => 'Español',    'icon' => 'es',    'sort' => '1',   'base' => '1',  'active' => '1'],
            ['id' => 'fr',  'name' => 'Français',   'icon' => 'fr',    'sort' => '0',   'base' => '0',  'active' => '0']
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminLangTableSeeder"
 */