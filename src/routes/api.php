<?php

/*
|----------------------------------
| LANGS
|----------------------------------
*/
Route::get('api/langs',                                         ['as' => 'lang',                    'uses' => 'Syscover\Admin\Controllers\LangController@index']);
Route::get('api/langs/{id}',                                    ['as' => 'showLang',                'uses' => 'Syscover\Admin\Controllers\LangController@show']);


/*
|----------------------------------
| COUNTRIES
|----------------------------------
*/
Route::get('api/countries/{lang?}',                             ['as' => 'country',                 'uses' => 'Syscover\Admin\Controllers\CountryController@index']);
Route::get('api/countries/{id}/{lang}',                         ['as' => 'showCountry',             'uses' => 'Syscover\Admin\Controllers\CountryController@show']);

/*
|----------------------------------
| TERRITORIAL AREAS 1
|----------------------------------
*/
Route::get('api/territorialareas1/{lang?}',                     ['as' => 'territorialArea1',        'uses' => 'Syscover\Admin\Controllers\TerritorialArea1Controller@index']);
Route::get('api/territorialareas1/{id}/{lang}',                 ['as' => 'showTerritorialArea1',    'uses' => 'Syscover\Admin\Controllers\TerritorialArea1Controller@show']);

/*
|----------------------------------
| PROFILES
|----------------------------------
*/
Route::get('api/profiles',                                      ['as' => 'profile',                 'uses' => 'Syscover\Admin\Controllers\ProfileController@index']);
Route::get('api/profiles/{id}',                                 ['as' => 'showProfile',             'uses' => 'Syscover\Admin\Controllers\ProfileController@show']);