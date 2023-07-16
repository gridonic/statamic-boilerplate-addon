<?php

namespace Gridonic\StatamicBoilerplateAddon\Http\Controllers;

use Illuminate\Routing\Controller;
use Statamic\Facades\Antlers;
use Statamic\Facades\Asset;
use Illuminate\Http\Request;

class ThumbnailFromPresetController extends Controller
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function thumbnail(string $preset, string $imageAssetIdEncoded) {
        if (!$this->isPreset($preset)) {
            abort(404);
        }

        // ID needs to be encoded because it can contain slashes.
        $imageAssetId = base64_decode($imageAssetIdEncoded);

        if (!$this->imageExists($imageAssetId)) {
            abort(404);
        }

        $url = Antlers::parse(sprintf('{{ glide src="%s" preset="%s" }}', $imageAssetId, $preset));

        // If the image manipulation cache is activated, the url points to a public image.
        if ($this->isImageManipulationCacheActive()) {
            // Return the image's url if the urlOnly flag is set, else serve the image directly.
            if ($this->request->query('urlOnly')) {
                return $url;
            }
            return response()->file(public_path($url));
        }

        // Else (no image manipulation cache) -> Redirect to glide url.
        return redirect($url, 301);
    }

    private function isImageManipulationCacheActive(): bool
    {
        return config('statamic.assets.image_manipulation.cache', false);
    }

    private function imageExists(string $imageId): bool
    {
        return Asset::find($imageId) !== null;
    }

    private function isPreset(string $preset): bool
    {
        $presets = config('statamic.assets.image_manipulation.presets', []);
        $presetNames = array_keys($presets);

        return in_array($preset, $presetNames);
    }
}
