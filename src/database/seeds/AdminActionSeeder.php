<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\Action;

class AdminActionSeeder extends Seeder
{
    public function run()
    {
        Action::insert([
            ['id' => 'access',      'name' => 'Access'],
            ['id' => 'create',      'name' => 'Create'],
            ['id' => 'create-lang', 'name' => 'Create language'],
            ['id' => 'delete',      'name' => 'Delete'],
            ['id' => 'edit',        'name' => 'Edit'],
            ['id' => 'list',        'name' => 'List'],
            ['id' => 'show',        'name' => 'Show']
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminActionSeeder"
 */
