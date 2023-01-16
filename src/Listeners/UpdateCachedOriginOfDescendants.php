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

    private function updateCacheOfLocalizedDescendants(Entry $entry)
    {
        $collectionHandle = $entry->collectionHandle();
        $entry->descendants()->each(function ($descendant) use ($collectionHandle) {
            $store = app('stache')->store("entries::${collectionHandle}");
            $store->forgetItem($descendant->id());
            $store->getItem($descendant->id());
        });
    }
}
