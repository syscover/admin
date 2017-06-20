<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\ActionQuery;

class AdminActionTableSeeder extends Seeder
{
    public function run()
    {
        ActionQuery::insert([
            ['id' => 'access',  'name' => 'Access'],
            ['id' => 'create',  'name' => 'Create'],
            ['id' => 'delete',  'name' => 'Delete'],
            ['id' => 'edit',    'name' => 'Edit'],
            ['id' => 'show',    'name' => 'Show']
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminActionTableSeeder"
 */