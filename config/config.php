<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Magic links
    |--------------------------------------------------------------------------
    |
    | Enable to expose a route to login via magic links.
    |
    */

    'magic_links_enabled' => env('BOILERPLATE_MAGIC_LINKS_ENABLED', false),
    'magic_links_secret' => env('BOILERPLATE_MAGIC_LINKS_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Multisite fixes
    |--------------------------------------------------------------------------
    |
    | Some fixes for multisite issues enabled by default.
    |
    | Disable these fixes if the project uses some other workaround, e.g. refreshing the Stache after each save.
    |
    */

    'multisite_set_data_from_origin' => env('BOILERPLATE_MULTISITE_SET_DATA_FROM_ORIGIN', true),
    'multisite_update_cached_origin_of_descendants' => env('BOILERPLATE_MULTISITE_UPDATE_CACHED_ORIGIN_OF_DESCENDANTS', true),

    /*
    |--------------------------------------------------------------------------
    | Theme
    |--------------------------------------------------------------------------
    |
    | Optionally spice up the login and other outside-the-control-panel
    | screens. You may choose between "rad" or "business" themes.
    |
    */

    'theme' => env('STATAMIC_THEME', 'business'),

    /*
    |--------------------------------------------------------------------------
    | White Labeling
    |--------------------------------------------------------------------------
    |
    | When in Pro Mode you may replace the Statamic name, logo, favicon,
    | and add your own CSS to the control panel to match your
    | company or client's brand.
    |
    */

    'custom_cms_name' => env('STATAMIC_CUSTOM_CMS_NAME', 'Gridonic Boilerplate'),
    'custom_logo_url' => [
        'nav' => env('STATAMIC_CUSTOM_LOGO_URL_NAV', '/static/gridonic-logo.svg'),
        'outside' => env('STATAMIC_CUSTOM_LOGO_URL_OUTSIDE', '/static/gridonic-logo-light.svg')
    ],
    'custom_favicon_url' => env('STATAMIC_CUSTOM_FAVICON_URL', '/favicon.ico'),
    'custom_css_url' => env('STATAMIC_CUSTOM_CSS_URL', '/static/statamic-custom-styles.css'),

];
