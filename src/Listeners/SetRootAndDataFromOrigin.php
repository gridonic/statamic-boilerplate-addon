<?php

namespace Gridonic\StatamicBoilerplateAddon\Listeners;

use Statamic\Entries\Entry;
use Statamic\Events\EntryCreated;

class SetRootAndDataFromOrigin
{
    public function handle(EntryCreated $event)
    {
        /** @var Entry $entry */
        $entry = $event->entry;
        if ($entry->isRoot()) {
            return;
        }

        /** @var Entry $root */
        $root = $entry->root();
        /** @var Entry $origin */
        $origin = $entry->origin();

        // Translations originating from root should not be handled, everything correct.
        if ($root->locale() === $origin->locale()) {
            return;
        }

        // For all other created translations: Set origin to root and copy translated data from old origin.
        $entry->origin($root);
        $entry->data($origin->data()->except(['slug', 'date', 'blueprint']));
        $entry->save();
    }
}
