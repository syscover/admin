<?php

/*
|----------------------------------
| LANGS
|----------------------------------
*/
Route::get('api/langs',                                         ['as' => 'lang',                            'uses' => 'Syscover\Admin\Controllers\LangController@index']);
Route::get('api/langs/{id}',                                    ['as' => 'showLang',                        'uses' => 'Syscover\Admin\Controllers\LangController@show']);


/*
|----------------------------------
| COUNTRIES
|----------------------------------
*/
Route::get('api/countries/{lang?}',                             ['as' => 'country',                         'uses' => 'Syscover\Admin\Controllers\CountryController@index']);
Route::get('api/countries/{id}/{lang}',                         ['as' => 'showCountry',                     'uses' => 'Syscover\Admin\Controllers\CountryController@show']);

/*
|----------------------------------
| TERRITORIAL AREAS 1
|----------------------------------
*/
Route::get('api/territorialareas1/{lang?}',                     ['as' => 'territorialArea1',                'uses' => 'Syscover\Admin\Controllers\TerritorialArea1Controller@index']);
Route::get('api/territorialareas1/{id}/{lang}',                 ['as' => 'showTerritorialArea1',            'uses' => 'Syscover\Admin\Controllers\TerritorialArea1Controller@show']);

/*
|----------------------------------
| TERRITORIAL AREAS 2
|----------------------------------
*/
Route::get('api/territorialareas2',                             ['as' => 'territorialArea2',                'uses' => 'Syscover\Admin\Controllers\TerritorialArea2Controller@index']);
Route::get('api/territorialareas2/{id}',                        ['as' => 'showTerritorialArea2',            'uses' => 'Syscover\Admin\Controllers\TerritorialArea2Controller@show']);

/*
|----------------------------------
| TERRITORIAL AREAS 3
|----------------------------------
*/
Route::get('api/territorialareas3',                             ['as' => 'territorialArea3',                'uses' => 'Syscover\Admin\Controllers\TerritorialArea3Controller@index']);
Route::get('api/territorialareas3/{id}',                        ['as' => 'showTerritorialArea3',            'uses' => 'Syscover\Admin\Controllers\TerritorialArea3Controller@show']);

/*
|----------------------------------
| PROFILES
|----------------------------------
*/
Route::get('api/profiles',                                      ['as' => 'profile',                         'uses' => 'Syscover\Admin\Controllers\ProfileController@index']);
Route::get('api/profiles/{id}',                                 ['as' => 'showProfile',                     'uses' => 'Syscover\Admin\Controllers\ProfileController@show']);

/*
|----------------------------------
| ACTIONS
|----------------------------------
*/
Route::get('api/actions',                                       ['as' => 'action',                          'uses' => 'Syscover\Admin\Controllers\ActionController@index']);
Route::get('api/actions/{id}',                                  ['as' => 'showAction',                      'uses' => 'Syscover\Admin\Controllers\ActionController@show']);

/*
|----------------------------------
| USERS
|----------------------------------
*/
Route::get('api/users',                                         ['as' => 'user',                            'uses' => 'Syscover\Admin\Controllers\UserController@index']);
Route::get('api/users/{id}',                                    ['as' => 'showUser',                        'uses' => 'Syscover\Admin\Controllers\UserController@show']);

/*
|----------------------------------
| PACKAGES
|----------------------------------
*/
Route::get('api/packages',                                      ['as' => 'package',                         'uses' => 'Syscover\Admin\Controllers\PackageController@index']);
Route::get('api/packages/{id}',                                 ['as' => 'showPackage',                     'uses' => 'Syscover\Admin\Controllers\PackageController@show']);

/*
|----------------------------------
| RESOURCES
|----------------------------------
*/
Route::get('api/resources',                                     ['as' => 'resource',                        'uses' => 'Syscover\Admin\Controllers\ResourceController@index']);
Route::get('api/resources/{id}',                                ['as' => 'showResource',                    'uses' => 'Syscover\Admin\Controllers\ResourceController@show']);