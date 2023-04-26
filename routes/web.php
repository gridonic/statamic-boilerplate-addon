<?php

use Gridonic\StatamicBoilerplateAddon\Http\Controllers\ThumbnailFromPresetController;
use Gridonic\StatamicBoilerplateAddon\Http\Controllers\MagicLinkController;
use Illuminate\Support\Facades\Route;

if (config('statamic.boilerplate.magic_links_enabled', false)) {
    Route::get('/portal-login/{token}', [MagicLinkController::class, 'login']);
}
Route::get('/thumbnail/{preset}/{imageAssetId}', [ThumbnailFromPresetController::class, 'thumbnail']);
