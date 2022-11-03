<?php

namespace Gridonic\StatamicBoilerplateAddon\Tags;

use Composer\InstalledVersions;
use Statamic\Tags\Tags;

class Boilerplate extends Tags
{
    /**
     * The {{ boilerplate:version }} tag.
     *
     * Returns the version of the root composer.json.
     */
    public function version()
    {
        $rootPackage = InstalledVersions::getRootPackage();

        return $rootPackage['version'] ?? '';
    }
}
