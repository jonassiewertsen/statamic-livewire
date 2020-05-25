<?php

namespace Jonassiewertsen\Livewire;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    protected $tags = [
        'Jonassiewertsen\Livewire\Tags\Livewire',
    ];
}
