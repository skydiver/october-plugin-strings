<?php

    return [

        'plugin' => [
            'name'        => 'Site Strings',
            'description' => 'Manage strings on your site',
            'config'      => [
                'label'       => 'Site Strings',
                'description' => 'Manage strings on your site.',
            ]
        ],

        'popup' => [
            'create_string' => 'Create New String',
            'update_string' => 'Update String',
        ],

        'fields' => [
            'string_label'  => [
                'label'       => 'Label',
                'description' => 'Enter the string label',
                'placeholder' => 'Enter the string label',
            ],
            'string_slug'  => [
                'label'       => 'Slug',
                'description' => 'Enter the string slug',
                'placeholder' => 'Enter the string slug',
            ],
            'string_scope'  => [
                'label'       => 'Scope',
                'description' => 'Enter the string\'s scope',
                'placeholder' => 'Enter the string\'s scope',
            ],
            'string_value' => [
                'label'       => 'Value',
                'description' => 'Enter the string\'s replacement value',
                'placeholder' => 'Enter the string\'s replacement value',
            ],
            'add_string' => [
                'label'       => 'Add New String',
            ],
            'delete_string' => [
                'label'       => 'Delete',
            ],
        ],

        'messages' => [
            'delete_string_warning' => 'Are you sure you want to delete this string?'
        ],

        'exceptions' => [
            23000 => 'We were unable to save the string because it already exists in the same scope. Please choose to edit the existing one.',
            10001 => 'We were unable to inject strings. Please contact the developer.'
        ],

    ];

?>