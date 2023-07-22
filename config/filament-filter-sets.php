<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    | Each Filter Set is related to a user. If you use a different class for
    | your user model you can specify it here.
    |
    */

    'models' => [
        'user' => App\Models\User::class,
        // 'filter_set' => null,
        // 'filter_set_user => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | User Table Column Name
    |--------------------------------------------------------------------------
    |
    | If you are using a different column for your user's name other than
    | Laravel's default `name` column, you can change it here. Another option,
    | if you are using a common `first_name` `last_name` structure would be to
    | create a virtual column in your database called `name`.
    | `$table->string('name')->virtualAs('concat(first_name, \' \', last_name)');`
    */

    'user_table_name_column' => 'name', // first_name

    /*
    |--------------------------------------------------------------------------
    | Filter Set Resource
    |--------------------------------------------------------------------------
    |
    | The Filter Set Resource provides a convenient way to view the Filter Sets
    | used throughout your application. If you extend the resource you can
    | disable the plug-in's resource here.
    |
    */

    'filter_set_resource' => [
        'enabled' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Favorites Bar Theme
    |--------------------------------------------------------------------------
    |
    | Filter Sets comes with three different themes for the Favorites Bar.
    | Select the theme you would like to use for your Favorites Bar.
    | Options are:
    | 1. links (default)
    | 2. links-simple
    | 3. tabs-brand
    | 4. tabs
    |
    */

    'favorites' => [
        'view' => 'links',
        'all_icon' => null, // 'heroicon-o-view-list
        'icon_position' => 'before', // or 'after'
        'size' => 'md', // 'xs', 'sm', 'md', 'lg'
    ],

    /*
    |--------------------------------------------------------------------------
    | Use Custom Theme
    |--------------------------------------------------------------------------
    |
    | Filter Sets compiles its CSS using Filament's default color scheme for
    | its 'primary', 'success', 'warning', and 'danger' classes. If you have
    | customized those colors in your app, set 'use_custom_theme` to `true`
    | and follow the instructions in the readme.md file.
    */

    'use_custom_theme' => true,

    /*
    |--------------------------------------------------------------------------
    | Colors in color picker
    |--------------------------------------------------------------------------
    |
    | Filter Set's color picker allows users to pick one of Filament's colors:
    | 'primary', 'success', 'warning', and 'danger' as well a 'secondary' (gray)
    | color. You can enable and disable these colors as you need. For example,
    | Out of the box Filament uses Tailwind's `amber` color for both `primary`
    | and `warning` therefore `warning` is disabled by default. If you are
    | using a custom theme with different `primary` and `warning` colors,
    | you probably want to enable the `warning` color below.
    | Note: To completely disable colors it's best to use Filter Set's Policy
    */

    'colors' => [
        'primary' => true,
        'success' => true,
        'info' => true,
        'warning' => false,
        'danger' => true,
        'secondary' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Forms
    |--------------------------------------------------------------------------
    |
    | The Filter Sets Create and Edit forms include helper_text for each input.
    | If you prefer not to display the helper text you can do that here. You
    | can edit the actual text by publishing and editing the lang files.
    |
    */

    'forms' => [
        'display_helper_text' => [
            'name' => false,
            'filters' => false,
            'public' => true,
            'favorite' => true,
            'global_favorite' => true,
        ],
    ],
];
