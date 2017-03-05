<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\Lang;

class AdminLangTableSeeder extends Seeder
{
    public function run()
    {
        Lang::insert([
            ['id' => 'de',  'name' => 'Deutsch',    'ico' => 'de.jpg',    'sort' => '0',   'base' => '0',  'active' => '0'],
            ['id' => 'en',  'name' => 'English',    'ico' => 'en.jpg',    'sort' => '0',   'base' => '0',  'active' => '0'],
            ['id' => 'es',  'name' => 'Español',    'ico' => 'es.jpg',    'sort' => '1',   'base' => '1',  'active' => '1'],
            ['id' => 'fr',  'name' => 'Français',   'ico' => 'fr.jpg',    'sort' => '0',   'base' => '0',  'active' => '0']
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminLangTableSeeder"
 */