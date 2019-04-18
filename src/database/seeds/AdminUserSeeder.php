<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [
                'id'                => 1,
                'name'              => 'Pulsar',
                'surname'           => 'Pulsar',
                'lang_id'           => 2,
                'email'             => 'admin@pulsar.local',
                'profile_id'        => '1',
                'active'            => '1',
                'user'              => 'admin@pulsar.local',
                'password'          => '$2y$10$3eFZAd31wPmg2mMZB/CZ4.CkcZKY9xr7A3Z9ou6mp7OkSIc3Qo.yW',
                'remember_token'    => null,
                'created_at'        => date("Y-m-d H:i:s"),
                'updated_at'        => date("Y-m-d H:i:s")
            ]
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminUserSeeder"
 */
