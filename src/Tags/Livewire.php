<?php


namespace Jonassiewertsen\Livewire\Tags;

use Livewire\LivewireBladeDirectives;

class Livewire extends \Statamic\Tags\Tags
{
    public function wildcard($expression) {
        return LivewireBladeDirectives::livewire($expression);
    }

    public function styles() {
        return \Livewire\Livewire::styles();
    }

    public function scripts() {
        return \Livewire\Livewire::scripts();
    }
}
