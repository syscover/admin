<?php

use Illuminate\Database\Seeder;
use Syscover\Admin\Models\Resource;

class AdminResourceTableSeeder extends Seeder {

    public function run()
    {
        Resource::insert([
            ['id' => 'admin-country',               'name' => 'Countries',                              'package_id' => 20],
            ['id' => 'admin-country-ta1',           'name' => 'Countries -- Territorial Area 1',       'package_id' => 20],
            ['id' => 'admin-country-ta2',           'name' => 'Countries -- Territorial Area 2',       'package_id' => 20],
            ['id' => 'admin-country-ta3',           'name' => 'Countries -- Territorial Area 3',       'package_id' => 20],
            ['id' => 'admin-lang',                  'name' => 'Languages',                              'package_id' => 20],
            ['id' => 'admin-oauth-access-token',    'name' => 'Oauth - Access tokens',                  'package_id' => 20],
            ['id' => 'admin-oauth-client',          'name' => 'Oauth - Clients',                        'package_id' => 20],
            ['id' => 'admin-package',               'name' => 'Packages',                               'package_id' => 20],
            ['id' => 'admin-perm-action',           'name' => 'Permissions -- Actions',                 'package_id' => 20],
            ['id' => 'admin-perm-perm',             'name' => 'Permissions -- Permissions',             'package_id' => 20],
            ['id' => 'admin-perm-profile',          'name' => 'Permissions -- Profiles',                'package_id' => 20],
            ['id' => 'admin-perm-resource',         'name' => 'Permissions -- Resources',               'package_id' => 20],
            ['id' => 'admin-user',                  'name' => 'Users',                                  'package_id' => 20],
            ['id' => 'admin-attachment-family',     'name' => 'Attachments - Attachment Families',      'package_id' => 20],
            ['id' => 'admin-attachment-mime',       'name' => 'Attachments - Attachments Mimes',        'package_id' => 20],
            ['id' => 'admin-field',                 'name' => 'Custom fields',                          'package_id' => 20],
            ['id' => 'admin-field-value',           'name' => 'Custom fields - Values',                 'package_id' => 20],
            ['id' => 'admin-field-group',           'name' => 'Custom fields - Groups',                 'package_id' => 20],
            ['id' => 'admin-report',                'name' => 'Reports',                                'package_id' => 20],
            ['id' => 'admin-oauth-client',          'name' => 'APIs -- Clients',                        'package_id' => 20],
            ['id' => 'admin-oauth-access-token',    'name' => 'APIs -- Access token',                   'package_id' => 20],
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="AdminResourceTableSeeder"
 */
