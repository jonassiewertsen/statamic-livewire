<?php

namespace Jonassiewertsen\Livewire;

use Livewire\Livewire;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $publishAfterInstall = false;

    protected $tags = [
        'Jonassiewertsen\Livewire\Tags\Livewire',
    ];

    public function boot(): void
    {
        parent::boot();

        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'statamic-livewire');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('statamic-livewire.php'),
            ], 'statamic-livewire');
        }

        $this->bootSyntesizers();
    }

    protected function bootSyntesizers()
    {
        if (! config('statamic-livewire.synthesizers.enabled', false)) {
            return;
        }

        $synthesizers = config('statamic-livewire.synthesizers.classes', []);

        foreach ($synthesizers as $synthesizer) {
            Livewire::propertySynthesizer($synthesizer);
        }
    }
}
