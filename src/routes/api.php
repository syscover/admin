<?php

/*
|----------------------------------
| LANGS
|----------------------------------
*/
Route::get('api/v1/admin/langs',                                         ['as' => 'lang',                            'uses' => 'Syscover\Admin\Controllers\LangController@index']);
Route::get('api/v1/admin/langs/{id}',                                    ['as' => 'showLang',                        'uses' => 'Syscover\Admin\Controllers\LangController@show']);
Route::post('api/v1/admin/langs',                                        ['as' => 'storeLang',                       'uses' => 'Syscover\Admin\Controllers\LangController@store']);
Route::post('api/v1/admin/langs/search',                                 ['as' => 'searchLang',                      'uses' => 'Syscover\Admin\Controllers\LangController@search']);
Route::put('api/v1/admin/langs/{id}',                                    ['as' => 'updateLang',                      'uses' => 'Syscover\Admin\Controllers\LangController@update']);
Route::delete('api/v1/admin/langs/{id}',                                 ['as' => 'destroyAction',                   'uses' => 'Syscover\Admin\Controllers\LangController@destroy']);

/*
|----------------------------------
| COUNTRIES
|----------------------------------
*/
Route::get('api/v1/admin/countries/{lang?}',                             ['as' => 'country',                         'uses' => 'Syscover\Admin\Controllers\CountryController@index']);
Route::get('api/v1/admin/countries/{id}/{lang}',                         ['as' => 'showCountry',                     'uses' => 'Syscover\Admin\Controllers\CountryController@show']);
Route::post('api/v1/admin/countries',                                    ['as' => 'storeCountry',                    'uses' => 'Syscover\Admin\Controllers\CountryController@store']);
Route::put('api/v1/admin/countries/{id}/{lang}',                         ['as' => 'updateAction',                    'uses' => 'Syscover\Admin\Controllers\CountryController@update']);
Route::delete('api/v1/admin/countries/{id}/{lang?}',                     ['as' => 'destroyAction',                   'uses' => 'Syscover\Admin\Controllers\CountryController@destroy']);

/*
|----------------------------------
| TERRITORIAL AREAS 1
|----------------------------------
*/
Route::get('api/v1/admin/territorialareas1/{lang?}',                     ['as' => 'territorialArea1',                'uses' => 'Syscover\Admin\Controllers\TerritorialArea1Controller@index']);
Route::get('api/v1/admin/territorialareas1/{id}/{lang}',                 ['as' => 'showTerritorialArea1',            'uses' => 'Syscover\Admin\Controllers\TerritorialArea1Controller@show']);

/*
|----------------------------------
| TERRITORIAL AREAS 2
|----------------------------------
*/
Route::get('api/v1/admin/territorialareas2',                             ['as' => 'territorialArea2',                'uses' => 'Syscover\Admin\Controllers\TerritorialArea2Controller@index']);
Route::get('api/v1/admin/territorialareas2/{id}',                        ['as' => 'showTerritorialArea2',            'uses' => 'Syscover\Admin\Controllers\TerritorialArea2Controller@show']);

/*
|----------------------------------
| TERRITORIAL AREAS 3
|----------------------------------
*/
Route::get('api/v1/admin/territorialareas3',                             ['as' => 'territorialArea3',                'uses' => 'Syscover\Admin\Controllers\TerritorialArea3Controller@index']);
Route::get('api/v1/admin/territorialareas3/{id}',                        ['as' => 'showTerritorialArea3',            'uses' => 'Syscover\Admin\Controllers\TerritorialArea3Controller@show']);

/*
|----------------------------------
| PROFILES
|----------------------------------
*/
Route::get('api/v1/admin/profiles',                                      ['as' => 'profile',                         'uses' => 'Syscover\Admin\Controllers\ProfileController@index']);
Route::get('api/v1/admin/profiles/{id}',                                 ['as' => 'showProfile',                     'uses' => 'Syscover\Admin\Controllers\ProfileController@show']);

/*
|----------------------------------
| ACTIONS
|----------------------------------
*/
Route::get('api/v1/admin/actions',                                       ['as' => 'action',                          'uses' => 'Syscover\Admin\Controllers\ActionController@index']);
Route::get('api/v1/admin/actions/{id}',                                  ['as' => 'showAction',                      'uses' => 'Syscover\Admin\Controllers\ActionController@show']);
Route::post('api/v1/admin/actions',                                      ['as' => 'storeAction',                     'uses' => 'Syscover\Admin\Controllers\ActionController@store']);
Route::put('api/v1/admin/actions/{id}',                                  ['as' => 'updateAction',                    'uses' => 'Syscover\Admin\Controllers\ActionController@update']);
Route::delete('api/v1/admin/actions/{id}',                               ['as' => 'destroyAction',                   'uses' => 'Syscover\Admin\Controllers\ActionController@destroy']);

/*
|----------------------------------
| USERS
|----------------------------------
*/
Route::get('api/v1/admin/users',                                         ['as' => 'user',                            'uses' => 'Syscover\Admin\Controllers\UserController@index']);
Route::get('api/v1/admin/users/{id}',                                    ['as' => 'showUser',                        'uses' => 'Syscover\Admin\Controllers\UserController@show']);

/*
|----------------------------------
| PACKAGES
|----------------------------------
*/
Route::get('api/v1/admin/packages',                                      ['as' => 'package',                         'uses' => 'Syscover\Admin\Controllers\PackageController@index']);
Route::get('api/v1/admin/packages/{id}',                                 ['as' => 'showPackage',                     'uses' => 'Syscover\Admin\Controllers\PackageController@show']);

/*
|----------------------------------
| RESOURCES
|----------------------------------
*/
Route::get('api/v1/admin/resources',                                     ['as' => 'resource',                        'uses' => 'Syscover\Admin\Controllers\ResourceController@index']);
Route::get('api/v1/admin/resources/{id}',                                ['as' => 'showResource',                    'uses' => 'Syscover\Admin\Controllers\ResourceController@show']);

/*
|----------------------------------
| CRON JOBS
|----------------------------------
*/
Route::get('api/v1/admin/cron-jobs',                                     ['as' => 'cronJob',                        'uses' => 'Syscover\Admin\Controllers\CronJobController@index']);
Route::get('api/v1/admin/cron-jobs/{id}',                                ['as' => 'showCronJob',                    'uses' => 'Syscover\Admin\Controllers\CronJobController@show']);