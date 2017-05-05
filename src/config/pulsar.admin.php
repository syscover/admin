<?php

return [

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
        (object)['id' => 1,    'key' => 'text',             'name' => 'Text',               'view' => 'pulsar::includes.html.form_text_group'],
        (object)['id' => 2,    'key' => 'select',           'name' => 'Select',             'view' => 'pulsar::includes.html.form_select_group'],
        (object)['id' => 3,    'key' => 'selectMultiple',   'name' => 'Select multiple',    'view' => 'pulsar::includes.html.form_select_group'],
        (object)['id' => 4,    'key' => 'number',           'name' => 'Number',             'view' => 'pulsar::includes.html.form_text_group'],
        (object)['id' => 5,    'key' => 'email',            'name' => 'Email',              'view' => 'pulsar::includes.html.form_text_group'],
        (object)['id' => 6,    'key' => 'checkbox',         'name' => 'Checkbox',           'view' => 'pulsar::includes.html.form_checkbox_group'],
        (object)['id' => 7,    'key' => 'select2',          'name' => 'Select 2',           'view' => 'pulsar::includes.html.form_select_group'],
        (object)['id' => 8,    'key' => 'selectMultiple2',  'name' => 'Select multiple 2',  'view' => 'pulsar::includes.html.form_select_group'],
        (object)['id' => 9,    'key' => 'textarea',         'name' => 'Text Area',          'view' => 'pulsar::includes.html.form_textarea_group'],
        (object)['id' => 10,   'key' => 'wysiwyg',          'name' => 'Wysiwyg',            'view' => 'pulsar::includes.html.form_wysiwyg_group'],
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