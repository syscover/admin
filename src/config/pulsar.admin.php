<?php

return [

    //******************************************************************************************************************
    //***   Base lang, set main application language
    //******************************************************************************************************************
    'base_lang' => env('BASE_LANG', 'en'),

    //******************************************************************************************************************
    //***   Resources that could contain custom fields
    //******************************************************************************************************************
    'resources_custom_fields' => [
        'cms-article-family',
        'market-product',
        'hotels-hotel',
        'spas-spa',
        'wineries-winery'
    ],

    //******************************************************************************************************************
    //***   Type fields to select on fields section
    //******************************************************************************************************************
    'field_types' => [
        (object)['id' => 'text',                'name' => 'Text'],
        (object)['id' => 'select',              'name' => 'Select'],
        (object)['id' => 'select-multiple',     'name' => 'Select multiple'],
        (object)['id' => 'number',              'name' => 'Number'],
        (object)['id' => 'email',               'name' => 'Email'],
        (object)['id' => 'checkbox',            'name' => 'Checkbox'],
        (object)['id' => 'select-2',            'name' => 'Select 2'],
        (object)['id' => 'select-multiple-2',   'name' => 'Select multiple 2'],
        (object)['id' => 'text-area',           'name' => 'Text Area'],
        (object)['id' => 'wysiwyg',             'name' => 'Wysiwyg'],
    ],

    //******************************************************************************************************************
    //***   Type data to select on fields section
    //******************************************************************************************************************
    'data_types' => [
        (object)['id' => 1,      'name' => 'String',            'type' => 'string'],
        (object)['id' => 2,      'name' => 'Boolean',           'type' => 'boolean'],
        (object)['id' => 3,      'name' => 'Integer',           'type' => 'integer'],
        (object)['id' => 4,      'name' => 'Float',             'type' => 'float'],
        (object)['id' => 5,      'name' => 'Array',             'type' => 'array'],
        (object)['id' => 6,      'name' => 'Object',            'type' => 'object'],
    ],

];