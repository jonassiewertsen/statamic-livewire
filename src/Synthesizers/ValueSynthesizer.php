<?php

namespace Jonassiewertsen\Livewire\Synthesizers;

use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;
use Statamic\Fields\Value;

use function Livewire\invade;

class ValueSynthesizer extends Synth
{
    public static $key = 'statamic-value';

    public static function match($target)
    {
        return $target instanceof Value;
    }

    public function dehydrate($target, $dehydrateChild)
    {
        $value = invade($target);

        $data = [
            'value' => $value->raw,
            'handle' => $value->handle,
            'fieldtype' => $value->fieldtype,
            'augmentable' => $value->augmentable,
            'shallow' => $value->shallow,
        ];

        foreach ($data as $key => $child) {
            $data[$key] = $dehydrateChild($key, $child);
        }

        return [$data, []];
    }

    public function hydrate($value, $meta, $hydrateChild)
    {
        foreach ($value as $key => $child) {
            $value[$key] = $hydrateChild($key, $child);
        }

        return new Value(...$value);
    }
}
