<?php

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
| LANGS
|----------------------------------
*/
Route::get('api/v1/admin/langs',                                         ['as' => 'adminLang',                            'uses' => 'Syscover\Admin\Controllers\LangController@index']);
Route::get('api/v1/admin/langs/{id}',                                    ['as' => 'showAdminLang',                        'uses' => 'Syscover\Admin\Controllers\LangController@show']);
Route::post('api/v1/admin/langs',                                        ['as' => 'storeAdminLang',                       'uses' => 'Syscover\Admin\Controllers\LangController@store']);
Route::post('api/v1/admin/langs/search',                                 ['as' => 'searchAdminLang',                      'uses' => 'Syscover\Admin\Controllers\LangController@search']);
Route::put('api/v1/admin/langs/{id}',                                    ['as' => 'updateAdminLang',                      'uses' => 'Syscover\Admin\Controllers\LangController@update']);
Route::delete('api/v1/admin/langs/{id}',                                 ['as' => 'destroyAdminLang',                     'uses' => 'Syscover\Admin\Controllers\LangController@destroy']);

/*
|----------------------------------
| COUNTRIES
|----------------------------------
*/
Route::get('api/v1/admin/countries/{lang?}',                             ['as' => 'adminCountry',                         'uses' => 'Syscover\Admin\Controllers\CountryController@index']);
Route::get('api/v1/admin/countries/{id}/{lang}',                         ['as' => 'showAdminCountry',                     'uses' => 'Syscover\Admin\Controllers\CountryController@show']);
Route::post('api/v1/admin/countries/search',                             ['as' => 'searchAdminCountry',                   'uses' => 'Syscover\Admin\Controllers\CountryController@search']);
Route::post('api/v1/admin/countries',                                    ['as' => 'storeAdminCountry',                    'uses' => 'Syscover\Admin\Controllers\CountryController@store']);
Route::put('api/v1/admin/countries/{id}/{lang}',                         ['as' => 'updateAdminCountry',                   'uses' => 'Syscover\Admin\Controllers\CountryController@update']);
Route::delete('api/v1/admin/countries/{id}/{lang?}',                     ['as' => 'destroyAdminCountry',                  'uses' => 'Syscover\Admin\Controllers\CountryController@destroy']);

/*
|----------------------------------
| TERRITORIAL AREAS 1
|----------------------------------
*/
Route::get('api/v1/admin/territorialareas1/{lang?}',                     ['as' => 'adminTerritorialArea1',                'uses' => 'Syscover\Admin\Controllers\TerritorialArea1Controller@index']);
Route::get('api/v1/admin/territorialareas1/{id}/{lang}',                 ['as' => 'showAdminTerritorialArea1',            'uses' => 'Syscover\Admin\Controllers\TerritorialArea1Controller@show']);

/*
|----------------------------------
| TERRITORIAL AREAS 2
|----------------------------------
*/
Route::get('api/v1/admin/territorialareas2',                             ['as' => 'adminTerritorialArea2',                'uses' => 'Syscover\Admin\Controllers\TerritorialArea2Controller@index']);
Route::get('api/v1/admin/territorialareas2/{id}',                        ['as' => 'showAdminTerritorialArea2',            'uses' => 'Syscover\Admin\Controllers\TerritorialArea2Controller@show']);

/*
|----------------------------------
| TERRITORIAL AREAS 3
|----------------------------------
*/
Route::get('api/v1/admin/territorialareas3',                             ['as' => 'adminTerritorialArea3',                'uses' => 'Syscover\Admin\Controllers\TerritorialArea3Controller@index']);
Route::get('api/v1/admin/territorialareas3/{id}',                        ['as' => 'showAdminTerritorialArea3',            'uses' => 'Syscover\Admin\Controllers\TerritorialArea3Controller@show']);

/*
|----------------------------------
| PROFILES
|----------------------------------
*/
Route::get('api/v1/admin/profiles',                                      ['as' => 'adminProfile',                         'uses' => 'Syscover\Admin\Controllers\ProfileController@index']);
Route::get('api/v1/admin/profiles/{id}',                                 ['as' => 'showAdminProfile',                     'uses' => 'Syscover\Admin\Controllers\ProfileController@show']);
Route::post('api/v1/admin/profiles',                                     ['as' => 'storeAdminProfile',                    'uses' => 'Syscover\Admin\Controllers\ProfileController@store']);
Route::post('api/v1/admin/profiles/search',                              ['as' => 'searchAdminProfile',                   'uses' => 'Syscover\Admin\Controllers\ProfileController@search']);
Route::put('api/v1/admin/profiles/{id}',                                 ['as' => 'updateAdminProfile',                   'uses' => 'Syscover\Admin\Controllers\ProfileController@update']);
Route::delete('api/v1/admin/profiles/{id}',                              ['as' => 'destroyAdminProfile',                  'uses' => 'Syscover\Admin\Controllers\ProfileController@destroy']);

/*
|----------------------------------
| ACTIONS
|----------------------------------
*/
Route::get('api/v1/admin/actions',                                       ['as' => 'adminAction',                          'uses' => 'Syscover\Admin\Controllers\ActionController@index']);
Route::get('api/v1/admin/actions/{id}',                                  ['as' => 'showAdminAction',                      'uses' => 'Syscover\Admin\Controllers\ActionController@show']);
Route::post('api/v1/admin/actions',                                      ['as' => 'storeAdminAction',                     'uses' => 'Syscover\Admin\Controllers\ActionController@store']);
Route::post('api/v1/admin/actions/search',                               ['as' => 'searchAdminAction',                    'uses' => 'Syscover\Admin\Controllers\ActionController@search']);
Route::put('api/v1/admin/actions/{id}',                                  ['as' => 'updateAdminAction',                    'uses' => 'Syscover\Admin\Controllers\ActionController@update']);
Route::delete('api/v1/admin/actions/{id}',                               ['as' => 'destroyAdminAction',                   'uses' => 'Syscover\Admin\Controllers\ActionController@destroy']);

/*
|----------------------------------
| USERS
|----------------------------------
*/
Route::get('api/v1/admin/users',                                         ['as' => 'adminUser',                            'uses' => 'Syscover\Admin\Controllers\UserController@index']);
Route::get('api/v1/admin/users/{id}',                                    ['as' => 'showAdminUser',                        'uses' => 'Syscover\Admin\Controllers\UserController@show']);

/*
|----------------------------------
| PACKAGES
|----------------------------------
*/
Route::get('api/v1/admin/packages',                                      ['as' => 'adminPackage',                         'uses' => 'Syscover\Admin\Controllers\PackageController@index']);
Route::get('api/v1/admin/packages/{id}',                                 ['as' => 'showAdminPackage',                     'uses' => 'Syscover\Admin\Controllers\PackageController@show']);

/*
|----------------------------------
| RESOURCES
|----------------------------------
*/
Route::get('api/v1/admin/resources',                                     ['as' => 'adminResource',                        'uses' => 'Syscover\Admin\Controllers\ResourceController@index']);
Route::get('api/v1/admin/resources/{id}',                                ['as' => 'showAdminResource',                    'uses' => 'Syscover\Admin\Controllers\ResourceController@show']);

/*
|----------------------------------
| CRON JOBS
|----------------------------------
*/
Route::get('api/v1/admin/cron-jobs',                                     ['as' => 'adminCronJob',                        'uses' => 'Syscover\Admin\Controllers\CronJobController@index']);
Route::get('api/v1/admin/cron-jobs/{id}',                                ['as' => 'showAdminCronJob',                    'uses' => 'Syscover\Admin\Controllers\CronJobController@show']);