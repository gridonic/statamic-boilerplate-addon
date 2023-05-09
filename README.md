# Statamic Boilerplate Addon

A Statamic addon providing common functionality and fixes among all Boilerplate instances.

## Features

### Login with Magic Links

The addon provides a route `/portal-login/{token}` to log a user into the control panel with a JWT token.

**Configuration**

* `BOILERPLATE_MAGIC_LINKS_ENABLED` Set to `true` or `false` to toggle this feature
* `BOILERPLATE_MAGIC_LINKS_SECRET` The secret used to encode the JWT token

### Create thumbnails via Glide from asset presets 

Statamic's [REST content API](https://statamic.dev/rest-api) only returns full images and no thumbnails. We cannot
use the API of glide to create thumbnails because it requires a secure token which can only be created server-side. We *could* just disable
the requirement of such token in the config (see `/config/statamic/assets.php`), but this enables mass image resize attacks.

As a workaround, the addon provides a route `/thumbnail/{preset}/{imageAssetId}` to create a thumbnail using the
given [asset preset](https://statamic.dev/image-manipulation#presets) and image id returned by the content API.

**Usage**

* Create a preset in `/config/statamic/assets.php`
* Client: `base64` encode the image id returned by the content API and send the request.

**Example**

Given the following response from the content API of an image

```json
{
"id": "images::paper-gd-01-1679495400.png",
"url": "/assets/images/paper-gd-01-1679495400.png",
"permalink": "https://my-url/assets/images/paper-gd-01-1679495400.png",
"api_url": "https://my-url/api/assets/images/paper-gd-01-1679495400.png"
}
```

Load a thumbnail in Vue or petite-vue:

```vue
<img :src="`/thumbnail/my-asset-preset/${btoa(asset.id)}`">
```

### Multi site fixes

* Always sets the entry of the default site as root of a newly created entry.
* When creating a translation, all data is copied from the originated entry. Note: Only works when *Origin Behaviour* of
  the collection is set to *Let the user select the origin*.
* Temporarily solves [multisite bug](https://github.com/statamic/cms/issues/6714) where translations do not inherit
  up-to-date data from origin entry.

**Configuration**

Set the following `env` variables to `true` to enable the fixes:

* `BOILERPLATE_MULTISITE_SET_DATA_FROM_ORIGIN`
* `BOILERPLATE_MULTISITE_UPDATE_CACHED_ORIGIN_OF_DESCENDANTS`

### Tags

* `{{ boilerplate:version }}` Outputs the version from the root `composer.json`


## Installation

Extend the `require` and `repositories` section of your `composer.json`:

```
"require": [
    "gridonic/statamic-boilerplate-addon": "^1.0"
],
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/gridonic/statamic-boilerplate-addon.git"
    }
]
```

Then, run `composer update gridonic/statamic-boilerplate-addon` to actually install this addon.

## Configuration

The addon publishes a config file located at `config/statamic/boilerplate.php`.
Most configuration options can be set via environment variables.
