<?php

namespace Jonassiewertsen\Livewire\Tags;

use Statamic\Tags\Tags;

class Livewire extends Tags
{
    /**
     * This will load your Livewire component in the Antlers view
     *
     * {{ livewire:your-component-name }}
     */
    public function wildcard($expression): string
    {
        return \Livewire\Livewire::mount($expression, $this->params->except('key')->toArray(), $this->params->only('key')->first());
    }

    /**
     * Sharing State Between Livewire And Alpine via entangle.
     *
     * {{ livewire:entangle property="showDropdown" modifier="live" }}
     */
    public function entangle(): string
    {
        $property = $this->params->get('property');
        $modifier = $this->params->get('modifier');
        $instanceId = $this->context['__livewire']->getId();

        $expression = ".entangle('{$property}')";

        if ($modifier) {
            $expression .= ".{$modifier}";
        }

        return "window.Livewire.find('$instanceId'){$expression}";
    }

    /**
     * Accessing the Livewire component.
     *
     * {{ livewire:this }}
     * {{ livewire:this set="('name', 'Jack')" }}
     */
    public function this(): string
    {
        $instanceId = $this->context['__livewire']->getId();

        if (!count($this->params)) {
            return "window.Livewire.find('{$instanceId}')";
        }

        $action = $this->params->take(1)->toArray();
        $method = key($action);
        $parameters = reset($action);

        return "window.Livewire.find('{$instanceId}').{$method}{$parameters}";
    }

    /**
     * Loading the livewire styles in antlers style
     *
     * {{ livewire:styles }}
     */
    public function styles(): string
    {
        return \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles();
    }

    /**
     * Loading the livewire scripts in antlers style
     *
     * {{ livewire:scripts }}
     */
    public function scripts(): string
    {
        return \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts();
    }

    /**
     * Prevent livewire from auto-injecting styles and scripts
     *
     * {{ livewire:scriptConfig }}
     */
    public function scriptConfig(): string
    {
        return \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scriptConfig();
    }
}
