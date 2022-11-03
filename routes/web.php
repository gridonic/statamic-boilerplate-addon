<?php

use Gridonic\StatamicBoilerplateAddon\Http\Controllers\MagicLinkController;
use Illuminate\Support\Facades\Route;

if (config('statamic.boilerplate.magic_links_enabled', false)) {
    Route::get('/portal-login/{token}', [MagicLinkController::class, 'login']);
}
