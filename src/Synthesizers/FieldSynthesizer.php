<?php

namespace Jonassiewertsen\Livewire\Synthesizers;

use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;
use Statamic\Fields\Field;

class FieldSynthesizer extends Synth
{
    public static $key = 'statamic-field';

    public static function match($target)
    {
        return $target instanceof Field;
    }

    public function dehydrate($target, $dehydrateChild)
    {
        $data = [
            'handle' => $target->handle(),
            'config' => $target->config(),
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

        return new Field(...$value);
    }
}
