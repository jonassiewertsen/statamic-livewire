<?php

namespace Jonassiewertsen\Livewire\Synthesizers;

use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;
use Statamic\Entries\Entry;
use Statamic\Entries\EntryCollection as StatamicEntryCollection;
use Illuminate\Support\Carbon;

class EntryCollectionSynthesizer extends Synth
{
    public static $key = 'statamic-entry-collection';

    public static function match($target)
    {
        return $target instanceof StatamicEntryCollection;
    }

    public function dehydrate($target)
    {
        $data = [];

        foreach ($target->all() as $entry) {
            $data[] = [
                'collection' => $entry->collection()->handle() ?? null,
                'data' => $entry->data()->all(),
                'date' => $entry->collection()->dated() ? $entry->date() : null,
                'id' => $entry->id(),
                'slug' => $entry->slug() ?? null,
            ];
        }

        return [$data, []];
    }

    public function hydrate($values)
    {
        $items = [];

        foreach ($values as $value) {
            $entry = Entry::make()
                ->id($value['id'])
                ->slug($value['slug'] ?? null)
                ->collection($value['collection'] ?? null)
                ->data($value['data']);

            if ($value['date']) {
                $date = $value['date'];

                if (!$date instanceof \Carbon\CarbonInterface) {
                    $date = Carbon::parse($date);
                }
            
                $entry->date($date ?? null);
            }

            $items[] = $entry;
        }

        return new StatamicEntryCollection($items);
    }
}
