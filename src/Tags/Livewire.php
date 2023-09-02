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
        return \Livewire\Livewire::mount($expression, $this->params->toArray());
    }

    /**
     * Sharing State Between Livewire And Alpine via entangle.
     *
     * The method is a small variation from \Livewire\Features\SupportEntangle\SupportEntangle
     * A few small changes had to be made to get the correct output.
     *
     * {{ livewire:entangle property='showDropdown' }}
     */
    public function entangle(): string
    {
        $expression = $this->params->get('property');
        $instanceId = $this->context['__livewire']->getId();

        // this condition is just copied from the original code but not implemented nor tested yet
        if ((object)($expression) instanceof \Livewire\WireDirective) {
            $value = $expression->value();
            $modifier = $expression->hasModifier('live') ? '.live' : '';
            return "window.Livewire.find('$instanceId').entangle('$value')$modifier";
        }

        return "window.Livewire.find('$instanceId').entangle('$expression')";
    }

    /**
     * Accessing the Livewire component.
     *
     * {{ livewire:this set="('name', 'Jack')" }}
     */
    public function this(): string
    {
        $instanceId = $this->context['__livewire']->getId();
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
