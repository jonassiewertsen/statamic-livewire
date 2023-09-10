<?php

namespace Jonassiewertsen\Livewire;

use Livewire\Livewire;
use Statamic\Providers\AddonServiceProvider;
use Jonassiewertsen\Livewire\Synthesizers\EntrySynthesizer;
use Jonassiewertsen\Livewire\Synthesizers\EntryCollectionSynthesizer;

class ServiceProvider extends AddonServiceProvider
{
    protected $publishAfterInstall = false;

    protected $tags = [
        'Jonassiewertsen\Livewire\Tags\Livewire',
    ];

    public function boot(): void
    {
        parent::boot();

        Livewire::propertySynthesizer(EntryCollectionSynthesizer::class);
        Livewire::propertySynthesizer(EntrySynthesizer::class);
    }
}
