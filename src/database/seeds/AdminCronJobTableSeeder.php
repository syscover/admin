<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\CronJob;

class AdminCronJobTableSeeder extends Seeder {

    public function run()
    {   
        CronJob::insert([
            ['name' => 'Check to create advanced search exports',       'package_id' => 2,     'cron_expression' => '*/2 * * * *',  'key' => '10',  'last_run' => 0,    'next_run' => 0,    'active' => 1],
            ['name' => 'Check to delivery reports task',                'package_id' => 2,     'cron_expression' => '0 0 * * *',    'key' => '11',  'last_run' => 0,    'next_run' => 0,    'active' => 1],
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminCronJobTableSeeder"
 */