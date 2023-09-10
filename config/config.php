<?php

return [

    /*
    |--------------------------------------------------------------------------
    | EXPERIMENTAL: Livewire Synthesizers
    |--------------------------------------------------------------------------
    |
    | 
    |
    */

    'synthesizers' => [

        'enabled' => false,

        'classes' => [
            \Jonassiewertsen\Livewire\Synthesizers\EntryCollectionSynthesizer::class,
            \Jonassiewertsen\Livewire\Synthesizers\EntrySynthesizer::class,
        ]
    ]
];