<?php

namespace Jonassiewertsen\Livewire;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $publishAfterInstall = false;

    protected $tags = [
        'Jonassiewertsen\Livewire\Tags\Livewire',
    ];
}
