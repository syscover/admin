<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\Resource;

class AdminResourceTableSeeder extends Seeder {

    public function run()
    {
        Resource::insert([
            ['object_id' => 'admin',                       'name' => 'Administration Package',                 'package_id' => 20],
            ['object_id' => 'admin-dashboard',             'name' => 'Dashboard',                              'package_id' => 20],
            ['object_id' => 'admin-country',               'name' => 'Countries',                              'package_id' => 20],
            ['object_id' => 'admin-country-at1',           'name' => 'Countries -- Territorial Areas 1',       'package_id' => 20],
            ['object_id' => 'admin-country-at2',           'name' => 'Countries -- Territorial Areas 2',       'package_id' => 20],
            ['object_id' => 'admin-country-at3',           'name' => 'Countries -- Territorial Areas 3',       'package_id' => 20],
            ['object_id' => 'admin-cron',                  'name' => 'Cron task',                              'package_id' => 20],
            ['object_id' => 'admin-email-account',         'name' => 'Email accounts',                         'package_id' => 20],
            ['object_id' => 'admin-google-services',       'name' => 'Google Services',                        'package_id' => 20],
            ['object_id' => 'admin-lang',                  'name' => 'Languages',                              'package_id' => 20],
            ['object_id' => 'admin-package',               'name' => 'Packages',                               'package_id' => 20],
            ['object_id' => 'admin-perm',                  'name' => 'Permissions',                            'package_id' => 20],
            ['object_id' => 'admin-perm-action',           'name' => 'Permissions -- Actions',                 'package_id' => 20],
            ['object_id' => 'admin-perm-perm',             'name' => 'Permissions -- Permissions',             'package_id' => 20],
            ['object_id' => 'admin-perm-profile',          'name' => 'Permissions -- Profiles',                'package_id' => 20],
            ['object_id' => 'admin-perm-resource',         'name' => 'Permissions -- Resources',               'package_id' => 20],
            ['object_id' => 'admin-user',                  'name' => 'Users',                                  'package_id' => 20],
            ['object_id' => 'admin-attachment',            'name' => 'Attachments',                            'package_id' => 20],
            ['object_id' => 'admin-attachment-family',     'name' => 'Attachments - Attachment Families',      'package_id' => 20],
            ['object_id' => 'admin-attachment-mime',       'name' => 'Attachments - Attachments Mimes',        'package_id' => 20],
            ['object_id' => 'admin-attachment-library',    'name' => 'Attachments - Library',                  'package_id' => 20],
            ['object_id' => 'admin-field',                 'name' => 'Custom fields',                          'package_id' => 20],
            ['object_id' => 'admin-field-value',           'name' => 'Custom fields - Values',                 'package_id' => 20],
            ['object_id' => 'admin-field-group',           'name' => 'Custom fields - Groups',                 'package_id' => 20],
            ['object_id' => 'admin-report',                'name' => 'Reports',                                'package_id' => 20],
            ['object_id' => 'pulsar',                      'name' => 'Pulsar',                                 'package_id' => 1]
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminResourceTableSeeder"
 */