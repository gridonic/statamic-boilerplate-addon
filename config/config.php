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
];
