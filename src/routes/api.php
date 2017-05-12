<?php


Route::get('api/v1/admin/test/create',                                   ['as' => 'adminTestCreate',                         'uses' => 'Syscover\Admin\Controllers\TestController@testCreate']);
Route::get('api/v1/admin/test/update',                                   ['as' => 'adminTestUpdate',                         'uses' => 'Syscover\Admin\Controllers\TestController@testUpdate']);
Route::get('api/v1/admin/test',                                   ['as' => 'adminTest',                         'uses' => 'Syscover\Admin\Controllers\TestController@test']);

/*
|----------------------------------
| CONFIG
|----------------------------------
*/
Route::get('api/v1/admin/config/env',                                   ['as' => 'adminConfig',                         'uses' => 'Syscover\Admin\Controllers\ConfigController@env']);
Route::get('api/v1/admin/config/bootstrap/{env}',                       ['as' => 'adminBootstrapConfig',                'uses' => 'Syscover\Admin\Controllers\ConfigController@bootstrap']);
Route::post('api/v1/admin/config/values',                               ['as' => 'adminValuesConfig',                   'uses' => 'Syscover\Admin\Controllers\ConfigController@values']);

/*
|----------------------------------
| USERS
|----------------------------------
*/
Route::get('api/v1/admin/user',                                         ['as' => 'adminUser',                           'uses' => 'Syscover\Admin\Controllers\UserController@index']);
Route::get('api/v1/admin/user/{id}',                                    ['as' => 'showAdminUser',                       'uses' => 'Syscover\Admin\Controllers\UserController@show']);

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
| COUNTRIES
|----------------------------------
*/
Route::get('api/v1/admin/country/{lang?}',                             ['as' => 'adminCountry',                         'uses' => 'Syscover\Admin\Controllers\CountryController@index']);
Route::get('api/v1/admin/country/{id}/{lang}',                         ['as' => 'showAdminCountry',                     'uses' => 'Syscover\Admin\Controllers\CountryController@show']);
Route::post('api/v1/admin/country/search',                             ['as' => 'searchAdminCountry',                   'uses' => 'Syscover\Admin\Controllers\CountryController@search']);
Route::post('api/v1/admin/country',                                    ['as' => 'storeAdminCountry',                    'uses' => 'Syscover\Admin\Controllers\CountryController@store']);
Route::put('api/v1/admin/country/{id}/{lang}',                         ['as' => 'updateAdminCountry',                   'uses' => 'Syscover\Admin\Controllers\CountryController@update']);
Route::delete('api/v1/admin/country/{id}/{lang?}',                     ['as' => 'destroyAdminCountry',                  'uses' => 'Syscover\Admin\Controllers\CountryController@destroy']);

/*
|----------------------------------
| TERRITORIAL AREAS 1
|----------------------------------
*/
Route::get('api/v1/admin/territorial-area-1/{lang?}',                     ['as' => 'adminTerritorialArea1',             'uses' => 'Syscover\Admin\Controllers\TerritorialArea1Controller@index']);
Route::get('api/v1/admin/territorial-area-1/{id}/{lang}',                 ['as' => 'showAdminTerritorialArea1',         'uses' => 'Syscover\Admin\Controllers\TerritorialArea1Controller@show']);

/*
|----------------------------------
| TERRITORIAL AREAS 2
|----------------------------------
*/
Route::get('api/v1/admin/territorial-area-2',                             ['as' => 'adminTerritorialArea2',                'uses' => 'Syscover\Admin\Controllers\TerritorialArea2Controller@index']);
Route::get('api/v1/admin/territorial-area-2/{id}',                        ['as' => 'showAdminTerritorialArea2',            'uses' => 'Syscover\Admin\Controllers\TerritorialArea2Controller@show']);

/*
|----------------------------------
| TERRITORIAL AREAS 3
|----------------------------------
*/
Route::get('api/v1/admin/territorial-area-3',                             ['as' => 'adminTerritorialArea3',                'uses' => 'Syscover\Admin\Controllers\TerritorialArea3Controller@index']);
Route::get('api/v1/admin/territorial-area-3/{id}',                        ['as' => 'showAdminTerritorialArea3',            'uses' => 'Syscover\Admin\Controllers\TerritorialArea3Controller@show']);

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
| CRON JOBS
|----------------------------------
*/
Route::get('api/v1/admin/cron-job',                                     ['as' => 'adminCronJob',                        'uses' => 'Syscover\Admin\Controllers\CronJobController@index']);
Route::get('api/v1/admin/cron-job/{id}',                                ['as' => 'showAdminCronJob',                    'uses' => 'Syscover\Admin\Controllers\CronJobController@show']);

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

//Route::get('api/v1/admin/field-value/create/{field}/{lang}/{offset}/{id?}',              ['as' => 'createCustomFieldValue',              'uses' => 'Syscover\Pulsar\Controllers\CustomFieldValueController@createRecord',               'resource' => 'admin-field-value',        'action' => 'create']);
//Route::post(config('pulsar.name') . '/pulsar/custom/fields/values/store/{field}/{lang}/{offset}/{id?}',              ['as' => 'storeCustomFieldValue',               'uses' => 'Syscover\Pulsar\Controllers\CustomFieldValueController@storeRecord',                'resource' => 'admin-field-value',        'action' => 'create']);
//Route::get(config('pulsar.name') . '/pulsar/custom/fields/values/{field}/{id}/edit/{lang}/{offset}',                 ['as' => 'editCustomFieldValue',                'uses' => 'Syscover\Pulsar\Controllers\CustomFieldValueController@editRecord',                 'resource' => 'admin-field-value',        'action' => 'access']);
//Route::put(config('pulsar.name') . '/pulsar/custom/fields/values/update/{field}/{lang}/{id}/{offset}',               ['as' => 'updateCustomFieldValue',              'uses' => 'Syscover\Pulsar\Controllers\CustomFieldValueController@updateRecord',               'resource' => 'admin-field-value',        'action' => 'edit']);
//Route::get(config('pulsar.name') . '/pulsar/custom/fields/values/delete/{field}/{lang}/{id}/{offset}',               ['as' => 'deleteCustomFieldValue',              'uses' => 'Syscover\Pulsar\Controllers\CustomFieldValueController@deleteRecord',               'resource' => 'admin-field-value',        'action' => 'delete']);
//Route::get(config('pulsar.name') . '/pulsar/custom/fields/values/delete/translation/{field}/{lang}/{id}/{offset}',   ['as' => 'deleteTranslationCustomFieldValue',   'uses' => 'Syscover\Pulsar\Controllers\CustomFieldValueController@deleteTranslationRecord',    'resource' => 'admin-field-value',        'action' => 'delete']);
//Route::delete(config('pulsar.name') . '/pulsar/custom/fields/values/delete/select/records/{field}/{lang}',           ['as' => 'deleteSelectCustomFieldValue',        'uses' => 'Syscover\Pulsar\Controllers\CustomFieldValueController@deleteRecordsSelect',        'resource' => 'admin-field-value',        'action' => 'delete']);

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
Route::get('api/v1/admin/action',                                       ['as' => 'adminAction',                          'uses' => 'Syscover\Admin\Controllers\ActionController@index']);
Route::get('api/v1/admin/action/{id}',                                  ['as' => 'showAdminAction',                      'uses' => 'Syscover\Admin\Controllers\ActionController@show']);
Route::post('api/v1/admin/action',                                      ['as' => 'storeAdminAction',                     'uses' => 'Syscover\Admin\Controllers\ActionController@store']);
Route::post('api/v1/admin/action/search',                               ['as' => 'searchAdminAction',                    'uses' => 'Syscover\Admin\Controllers\ActionController@search']);
Route::put('api/v1/admin/action/{id}',                                  ['as' => 'updateAdminAction',                    'uses' => 'Syscover\Admin\Controllers\ActionController@update']);
Route::delete('api/v1/admin/action/{id}',                               ['as' => 'destroyAdminAction',                   'uses' => 'Syscover\Admin\Controllers\ActionController@destroy']);