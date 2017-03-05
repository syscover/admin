<?php

/*
|-----------------
| LANGS
|-----------------
*/
Route::get('api/langs',                     ['as' => 'lang',            'uses' => 'Syscover\Admin\Controllers\LangController@index']);
Route::get('api/langs/{id}',                ['as' => 'showLang',        'uses' => 'Syscover\Admin\Controllers\LangController@show']);


/*
|-----------------
| COUNTRIES
|-----------------
*/
Route::get('api/countries/{lang?}',         ['as' => 'country',         'uses' => 'Syscover\Admin\Controllers\CountryController@index']);
Route::get('api/countries/{id}/{lang?}',    ['as' => 'showCountry',     'uses' => 'Syscover\Admin\Controllers\CountryController@show']);