# Statamic Boilerplate Addon

A Statamic addon providing common functionality and fixes among all Boilerplate instances.

## Features

* Provides a ``{{ boilerplate:version }}`` tag to output the version from the root `composer.json`.
* Offers Statamic control panel logins via magic links from our portal.
* Provides a web route `/thumbnail/{preset}/{imageAssetId}` to output a thumbnail (via Glide)
using the given asset preset and id. You need to `base64` encode the image asset id.
* Multi language extensions
  * Always sets the entry of the default site as root of a newly created entry.
  * When creating a translation, all data is copied from the originated entry. Note: Only works when *Origin Behaviour* of
the collection is set to *Let the user select the origin*. 
  * Temporarily solves [multisite bug](https://github.com/statamic/cms/issues/6714) where translations do not inherit
up-to-date data from origin entry. 

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
