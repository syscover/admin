<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\Action;

class AdminActionTableSeeder extends Seeder
{
    public function run()
    {
        Action::insert([
            ['object_id' => 'access',  'name' => 'Access'],
            ['object_id' => 'create',  'name' => 'Create'],
            ['object_id' => 'delete',  'name' => 'Delete'],
            ['object_id' => 'edit',    'name' => 'Edit'],
            ['object_id' => 'show',    'name' => 'Show']
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminActionTableSeeder"
 */