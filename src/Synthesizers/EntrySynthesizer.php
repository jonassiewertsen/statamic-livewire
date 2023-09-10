<?php

namespace Jonassiewertsen\Livewire\Synthesizers;

use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;
use Statamic\Entries\Entry as StatamicEntry;
use Statamic\Facades\Entry;

class EntrySynthesizer extends Synth
{
    public static $key = 'entry-collection';

    public static function match($target)
    {
        return $target instanceof StatamicEntry;
    }

    public function dehydrate($entry)
    {
        return [
            [
                'collection' => $entry->collection()->handle() ?? null,
                'data' => $entry->data()->all(),
                'date' => $entry->collection()->dated() ? $entry->date() : null,
                'id' => $entry->id(),
                'slug' => $entry->slug() ?? null,
            ], []];
    }

    public function hydrate($value)
    {
        $entry = Entry::make()
            ->id($value['id'])
            ->slug($value['slug'] ?? null)
            ->collection($value['collection'] ?? null);

        if ($value['date']) {
            $entry->date($value['date'] ?? null);
        }

        return $entry;
    }
}
