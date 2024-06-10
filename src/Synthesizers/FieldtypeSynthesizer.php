<?php

namespace Jonassiewertsen\Livewire\Synthesizers;

use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;
use Statamic\Fields\Fieldtype;

class FieldtypeSynthesizer extends Synth
{
    public static $key = 'statamic-fieldtype';

    public static function match($target)
    {
        return $target instanceof Fieldtype;
    }

    public function dehydrate($target, $dehydrateChild)
    {
        $data = [
            'field' => $target->field(),
        ];

        foreach ($data as $key => $child) {
            $data[$key] = $dehydrateChild($key, $child);
        }

        return [
            $data,
            ['class' => get_class($target)],
        ];
    }

    public function hydrate($value, $meta, $hydrateChild)
    {
        foreach ($value as $key => $child) {
            $value[$key] = $hydrateChild($key, $child);
        }

        return app($meta['class'])->setField($value['field']);
    }
}
