<?php

Route::group(['prefix' => 'api/v1', 'middleware' => ['api']], function () {

    // Config
    Route::get('admin/config/bootstrap',                            'Syscover\Admin\Controllers\ConfigController@bootstrap')->name('api.admin_bootstrap');

    // Login
    Route::post('login',                                            'Syscover\Admin\Controllers\Auth\AuthController@login')->name('api.admin_login');

    // Download files
    Route::post('admin/file-manager/read',                          'Syscover\Admin\Controllers\FileManagerController@read')->name('api.admin_read');
});

// Route::group(['prefix' => 'api/v1', 'middleware' => ['api', 'client']], function () {
Route::group(['prefix' => 'api/v1', 'middleware' => ['api']], function () {

    // Updates
    Route::get('admin/updates/check',                               'Syscover\Admin\Controllers\UpdateController@check')->name('api.admin_updates_check');
    Route::get('admin/updates/execute',                             'Syscover\Admin\Controllers\UpdateController@execute')->name('api.admin_updates_execute');

    // Actions
    Route::get('admin/action',                                       'Syscover\Admin\Controllers\ActionController@index')->name('api.admin_action');
    Route::get('admin/action/{id}',                                  'Syscover\Admin\Controllers\ActionController@show')->name('api.admin_show_action');
    Route::post('admin/action',                                      'Syscover\Admin\Controllers\ActionController@store')->name('api.admin_store_action');
    Route::post('admin/action/search',                               'Syscover\Admin\Controllers\ActionController@search')->name('api.admin_search_action');
    Route::put('admin/action/{id}',                                  'Syscover\Admin\Controllers\ActionController@update')->name('api.admin_update_action');
    Route::delete('admin/action/{id}',                               'Syscover\Admin\Controllers\ActionController@destroy')->name('api.admin_destroy_action');
});








// CONFIG
Route::post('api/v1/admin/config/values',                                  'Syscover\Admin\Controllers\ConfigController@values')->name('api.adminValuesConfig');

// COUNTRY
Route::get('api/v1/admin/country/{lang?}',                                 'Syscover\Admin\Controllers\CountryController@index')->name('api.admin_country');
Route::get('api/v1/admin/country/{id}/{lang}',                             'Syscover\Admin\Controllers\CountryController@show')->name('api.admin_show_country');
Route::post('api/v1/admin/country/search',                                 'Syscover\Admin\Controllers\CountryController@search')->name('api.admin_search_country');
Route::post('api/v1/admin/country',                                        'Syscover\Admin\Controllers\CountryController@store')->name('api.admin_store_country');
Route::put('api/v1/admin/country/{id}/{lang}',                             'Syscover\Admin\Controllers\CountryController@update')->name('api.admin_update_country');
Route::delete('api/v1/admin/country/{id}/{lang?}',                         'Syscover\Admin\Controllers\CountryController@destroy')->name('api.admin_destroy_country');

// TERRITORIAL AREAS 1
Route::get('api/v1/admin/territorial-area-1',                           'Syscover\Admin\Controllers\TerritorialArea1Controller@index')->name('adminTerritorialArea1');
Route::get('api/v1/admin/territorial-area-1/{id}/{lang}',               'Syscover\Admin\Controllers\TerritorialArea1Controller@show')->name('showAdminTerritorialArea1');

// TERRITORIAL AREAS 2
Route::get('api/v1/admin/territorial-area-2',                           'Syscover\Admin\Controllers\TerritorialArea2Controller@index')->name('adminTerritorialArea2');
Route::get('api/v1/admin/territorial-area-2/{id}',                      'Syscover\Admin\Controllers\TerritorialArea2Controller@show')->name('showAdminTerritorialArea2');

// TERRITORIAL AREAS 3
Route::get('api/v1/admin/territorial-area-3',                           'Syscover\Admin\Controllers\TerritorialArea3Controller@index')->name('adminTerritorialArea3');
Route::get('api/v1/admin/territorial-area-3/{id}',                      'Syscover\Admin\Controllers\TerritorialArea3Controller@show')->name('showAdminTerritorialArea3');

// ATTACHMENTS
Route::post('api/v1/admin/attachment-upload',                           'Syscover\Admin\Controllers\AttachmentController@index')->name('pulsar.admin_attachment_upload');
Route::post('api/v1/admin/attachment-upload/crop',                      'Syscover\Admin\Controllers\AttachmentController@crop')->name('cropAdminAttachmentUpload');
Route::post('api/v1/admin/attachment-upload/delete',                    'Syscover\Admin\Controllers\AttachmentController@destroy')->name('destroyAdminAttachmentUpload');

// ATTACHMENTS WYSIWYG
Route::post('api/v1/admin/wysiwyg/upload',                              'Syscover\Admin\Controllers\AttachmentController@wysiwygUpload')->name('adminWysiwygUpload');


Route::group(['prefix' => 'api/v1', 'middleware' => ['api', 'client']], function () {

    // USER
    Route::get('admin/user',                                            'Syscover\Admin\Controllers\UserController@index')->name('api.admin_user');
    Route::get('admin/user/{id}',                                       'Syscover\Admin\Controllers\UserController@show')->name('api.admin_show_user');
    Route::post('admin/user',                                           'Syscover\Admin\Controllers\UserController@store')->name('api.admin_store_user');
    Route::post('admin/user/search',                                    'Syscover\Admin\Controllers\UserController@search')->name('api.admin_search_user');
    Route::put('api/v1/admin/user/{id}',                                'Syscover\Admin\Controllers\UserController@update')->name('api.admin_update_user');
    Route::delete('api/v1/admin/user/{id}',                             'Syscover\Admin\Controllers\UserController@destroy')->name('api.admin_destroy_user');


    /*
    |----------------------------------
    | LANGS
    |----------------------------------
    */
    Route::get('api/v1/admin/lang',                                         ['as' => 'adminLang',                           'uses' => 'Syscover\Admin\Controllers\LangController@index']);
    Route::get('api/v1/admin/lang/{id}',                                    ['as' => 'showAdminLang',                       'uses' => 'Syscover\Admin\Controllers\LangController@show']);
    Route::post('api/v1/admin/lang',                                        ['as' => 'storeAdminLang',                      'uses' => 'Syscover\Admin\Controllers\LangController@store']);
    Route::post('api/v1/admin/lang/search',                                 ['as' => 'searchAdminLang',                     'uses' => 'Syscover\Admin\Controllers\LangController@search']);
    Route::put('api/v1/admin/lang/{id}',                                    ['as' => 'updateAdminLang',                     'uses' => 'Syscover\Admin\Controllers\LangController@update']);
    Route::delete('api/v1/admin/lang/{id}',                                 ['as' => 'destroyAdminLang',                    'uses' => 'Syscover\Admin\Controllers\LangController@destroy']);

    /*
    |----------------------------------
    | PACKAGES
    |----------------------------------
    */
    Route::get('api/v1/admin/package',                                      ['as' => 'adminPackage',                        'uses' => 'Syscover\Admin\Controllers\PackageController@index']);
    Route::get('api/v1/admin/package/{id}',                                 ['as' => 'showAdminPackage',                    'uses' => 'Syscover\Admin\Controllers\PackageController@show']);
    Route::post('api/v1/admin/package',                                     ['as' => 'storeAdminPackage',                   'uses' => 'Syscover\Admin\Controllers\PackageController@store']);
    Route::post('api/v1/admin/package/search',                              ['as' => 'searchAdminPackage',                  'uses' => 'Syscover\Admin\Controllers\PackageController@search']);
    Route::put('api/v1/admin/package/{id}',                                 ['as' => 'updateAdminPackage',                  'uses' => 'Syscover\Admin\Controllers\PackageController@update']);
    Route::delete('api/v1/admin/package/{id}',                              ['as' => 'destroyAdminPackage',                 'uses' => 'Syscover\Admin\Controllers\PackageController@destroy']);

    /*
    |----------------------------------
    | FIELD
    |----------------------------------
    */
    Route::get('api/v1/admin/field/{lang?}',                                ['as' => 'adminField',                          'uses' => 'Syscover\Admin\Controllers\FieldController@index']);
    Route::get('api/v1/admin/field/{id}/{lang}',                            ['as' => 'showAdminField',                      'uses' => 'Syscover\Admin\Controllers\FieldController@show']);
    Route::post('api/v1/admin/field/search',                                ['as' => 'searchAdminField',                    'uses' => 'Syscover\Admin\Controllers\FieldController@search']);
    Route::post('api/v1/admin/field',                                       ['as' => 'storeAdminField',                     'uses' => 'Syscover\Admin\Controllers\FieldController@store']);
    Route::put('api/v1/admin/field/{id}/{lang}',                            ['as' => 'updateAdminField',                    'uses' => 'Syscover\Admin\Controllers\FieldController@update']);
    Route::delete('api/v1/admin/field/{id}/{lang?}',                        ['as' => 'destroyAdminField',                   'uses' => 'Syscover\Admin\Controllers\FieldController@destroy']);

    /*
    |--------------------------------------------------------------------------
    | FIELD VALUE
    |--------------------------------------------------------------------------
    */
    Route::get('api/v1/admin/field-value/{field}/{lang?}',                  ['as' => 'adminFieldValue',                     'uses' => 'Syscover\Admin\Controllers\FieldValueController@index']);
    Route::get('api/v1/admin/field-value/{field}/{id}/{lang}',              ['as' => 'showAdminFieldValue',                 'uses' => 'Syscover\Admin\Controllers\FieldValueController@show']);
    Route::post('api/v1/admin/field-value/search',                          ['as' => 'searchAdminFieldValue',               'uses' => 'Syscover\Admin\Controllers\FieldValueController@search']);
    Route::post('api/v1/admin/field-value',                                 ['as' => 'storeAdminFieldValue',                'uses' => 'Syscover\Admin\Controllers\FieldValueController@store']);
    Route::put('api/v1/admin/field-value/{field}/{id}/{lang}',              ['as' => 'updateAdminFieldValue',               'uses' => 'Syscover\Admin\Controllers\FieldValueController@update']);
    Route::delete('api/v1/admin/field-value/{field}/{id}/{lang?}',          ['as' => 'destroyAdminFieldValue',              'uses' => 'Syscover\Admin\Controllers\FieldValueController@destroy']);

    /*
    |----------------------------------
    | FIELD GROUPS
    |----------------------------------
    */
    Route::get('api/v1/admin/field-group',                                  ['as' => 'adminFieldGroup',                     'uses' => 'Syscover\Admin\Controllers\FieldGroupController@index']);
    Route::get('api/v1/admin/field-group/{id}',                             ['as' => 'showAdminFieldGroup',                 'uses' => 'Syscover\Admin\Controllers\FieldGroupController@show']);
    Route::post('api/v1/admin/field-group',                                 ['as' => 'storeAdminFieldGroup',                'uses' => 'Syscover\Admin\Controllers\FieldGroupController@store']);
    Route::post('api/v1/admin/field-group/search',                          ['as' => 'searchAdminFieldGroup',               'uses' => 'Syscover\Admin\Controllers\FieldGroupController@search']);
    Route::put('api/v1/admin/field-group/{id}',                             ['as' => 'updateAdminFieldGroup',               'uses' => 'Syscover\Admin\Controllers\FieldGroupController@update']);
    Route::delete('api/v1/admin/field-group/{id}',                          ['as' => 'destroyAdminFieldGroup',              'uses' => 'Syscover\Admin\Controllers\FieldGroupController@destroy']);

    /*
    |----------------------------------
    | PROFILES
    |----------------------------------
    */
    Route::get('api/v1/admin/profile',                                      ['as' => 'adminProfile',                        'uses' => 'Syscover\Admin\Controllers\ProfileController@index']);
    Route::get('api/v1/admin/profile/{id}',                                 ['as' => 'showAdminProfile',                    'uses' => 'Syscover\Admin\Controllers\ProfileController@show']);
    Route::post('api/v1/admin/profile',                                     ['as' => 'storeAdminProfile',                   'uses' => 'Syscover\Admin\Controllers\ProfileController@store']);
    Route::post('api/v1/admin/profile/search',                              ['as' => 'searchAdminProfile',                  'uses' => 'Syscover\Admin\Controllers\ProfileController@search']);
    Route::put('api/v1/admin/profile/{id}',                                 ['as' => 'updateAdminProfile',                  'uses' => 'Syscover\Admin\Controllers\ProfileController@update']);
    Route::delete('api/v1/admin/profile/{id}',                              ['as' => 'destroyAdminProfile',                 'uses' => 'Syscover\Admin\Controllers\ProfileController@destroy']);

    /*
    |----------------------------------
    | RESOURCES
    |----------------------------------
    */
    Route::get('api/v1/admin/resource',                                     ['as' => 'adminResource',                       'uses' => 'Syscover\Admin\Controllers\ResourceController@index']);
    Route::get('api/v1/admin/resource/{id}',                                ['as' => 'showAdminResource',                   'uses' => 'Syscover\Admin\Controllers\ResourceController@show']);
    Route::post('api/v1/admin/resource',                                    ['as' => 'storeAdminResource',                  'uses' => 'Syscover\Admin\Controllers\ResourceController@store']);
    Route::post('api/v1/admin/resource/search',                             ['as' => 'searchAdminResource',                 'uses' => 'Syscover\Admin\Controllers\ResourceController@search']);
    Route::put('api/v1/admin/resource/{id}',                                ['as' => 'updateAdminResource',                 'uses' => 'Syscover\Admin\Controllers\ResourceController@update']);
    Route::delete('api/v1/admin/resource/{id}',                             ['as' => 'destroyAdminResource',                'uses' => 'Syscover\Admin\Controllers\ResourceController@destroy']);

    /*
    |----------------------------------
    | ACTIONS
    |----------------------------------
    */
    Route::get('api/v1/admin/action',                                       ['as' => 'adminAction',                         'uses' => 'Syscover\Admin\Controllers\ActionController@index']);
    Route::get('api/v1/admin/action/{id}',                                  ['as' => 'showAdminAction',                     'uses' => 'Syscover\Admin\Controllers\ActionController@show']);
    Route::post('api/v1/admin/action',                                      ['as' => 'storeAdminAction',                    'uses' => 'Syscover\Admin\Controllers\ActionController@store']);
    Route::post('api/v1/admin/action/search',                               ['as' => 'searchAdminAction',                   'uses' => 'Syscover\Admin\Controllers\ActionController@search']);
    Route::put('api/v1/admin/action/{id}',                                  ['as' => 'updateAdminAction',                   'uses' => 'Syscover\Admin\Controllers\ActionController@update']);
    Route::delete('api/v1/admin/action/{id}',                               ['as' => 'destroyAdminAction',                  'uses' => 'Syscover\Admin\Controllers\ActionController@destroy']);

    /*
    |----------------------------------
    | ATTACHMENT MIMES
    |----------------------------------
    */
    Route::get('api/v1/admin/attachment-mime',                              ['as' => 'adminAttachmentMime',                 'uses' => 'Syscover\Admin\Controllers\AttachmentMimeController@index']);
    Route::get('api/v1/admin/attachment-mime/{id}',                         ['as' => 'showAdminAttachmentMime',             'uses' => 'Syscover\Admin\Controllers\AttachmentMimeController@show']);
    Route::post('api/v1/admin/attachment-mime',                             ['as' => 'storeAdminAttachmentMime',            'uses' => 'Syscover\Admin\Controllers\AttachmentMimeController@store']);
    Route::post('api/v1/admin/attachment-mime/search',                      ['as' => 'searchAdminAttachmentMime',           'uses' => 'Syscover\Admin\Controllers\AttachmentMimeController@search']);
    Route::put('api/v1/admin/attachment-mime/{id}',                         ['as' => 'updateAdminAttachmentMime',           'uses' => 'Syscover\Admin\Controllers\AttachmentMimeController@update']);
    Route::delete('api/v1/admin/attachment-mime/{id}',                      ['as' => 'destroyAdminAttachmentMime',          'uses' => 'Syscover\Admin\Controllers\AttachmentMimeController@destroy']);

    /*
    |----------------------------------
    | ATTACHMENT FAMILIES
    |----------------------------------
    */
    Route::get('api/v1/admin/attachment-family',                            ['as' => 'adminAttachmentFamily',               'uses' => 'Syscover\Admin\Controllers\AttachmentFamilyController@index']);
    Route::get('api/v1/admin/attachment-family/{id}',                       ['as' => 'showAdminAttachmentFamily',           'uses' => 'Syscover\Admin\Controllers\AttachmentFamilyController@show']);
    Route::post('api/v1/admin/attachment-family',                           ['as' => 'storeAdminAttachmentFamily',          'uses' => 'Syscover\Admin\Controllers\AttachmentFamilyController@store']);
    Route::post('api/v1/admin/attachment-family/search',                    ['as' => 'searchAdminAttachmentFamily',         'uses' => 'Syscover\Admin\Controllers\AttachmentFamilyController@search']);
    Route::put('api/v1/admin/attachment-family/{id}',                       ['as' => 'updateAdminAttachmentFamily',         'uses' => 'Syscover\Admin\Controllers\AttachmentFamilyController@update']);
    Route::delete('api/v1/admin/attachment-family/{id}',                    ['as' => 'destroyAdminAttachmentFamily',        'uses' => 'Syscover\Admin\Controllers\AttachmentFamilyController@destroy']);
});
