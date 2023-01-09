<?php

namespace Gridonic\StatamicBoilerplateAddon\Listeners;

use Statamic\Entries\Entry;
use Statamic\Events\EntrySaved;

/**
 * This is a workaround for https://github.com/statamic/cms/issues/6714
 * Remove once this issue is resolved!
 */
class UpdateCachedOriginOfDescendants
{
    public function handle(EntrySaved $event) {
        $this->updateCacheOfLocalizedDescendants($event->entry);
    }

    private function updateCacheOfLocalizedDescendants(Entry $parent)
    {
        if ($parent->descendants()->count() === 0) {
            return;
        }

        $directDescendants = $parent->descendants()->filter(function ($descendant) use ($parent) {
            return $descendant->origin()->id() === $parent->id();
        });
        $directDescendants->each(function ($descendant) use ($parent) {
            $descendant->origin($parent);
            Statamic\Facades\Entry::save($descendant);
            $this->updateCacheOfLocalizedDescendants($descendant);
        });
    }
}
