<?php

/*
|----------------------------------
| LANGS
|----------------------------------
*/
Route::get('api/langs',                                         ['as' => 'lang',                    'uses' => 'Syscover\Admin\Controllers\LangController@index']);
Route::get('api/langs/show/{id}',                               ['as' => 'showLang',                'uses' => 'Syscover\Admin\Controllers\LangController@show']);


/*
|----------------------------------
| COUNTRIES
|----------------------------------
*/
Route::get('api/countries/{lang?}',                             ['as' => 'country',                 'uses' => 'Syscover\Admin\Controllers\CountryController@index']);
Route::get('api/countries/show/{id}/{lang}',                    ['as' => 'showCountry',             'uses' => 'Syscover\Admin\Controllers\CountryController@show']);

/*
|----------------------------------
| TERRITORIAL AREAS 1
|----------------------------------
*/
Route::get('api/territorialareas1/{lang?}',                     ['as' => 'territorialArea1',        'uses' => 'Syscover\Admin\Controllers\TerritorialArea1Controller@index']);
Route::get('api/territorialareas1/show/{id}/{lang}',            ['as' => 'showTerritorialArea1',    'uses' => 'Syscover\Admin\Controllers\TerritorialArea1Controller@show']);