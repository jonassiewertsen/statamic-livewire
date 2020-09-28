<?php

namespace Jonassiewertsen\Livewire\Tags;

use Illuminate\Support\Str;

class Livewire extends \Statamic\Tags\Tags
{
    /**
     * This will load your Livewire component in the antlers view
     *
     * {{ livewire:your-component-name }}
     *
     * The code has been copied shameless from /Livewire/LivewireBladeDirectives
     * A few small changes have been made to output the dom correctly.
     *
     * @param $expression
     * @return mixed
     */
    public function wildcard($expression)
    {
        /**
         * Fetching all parameters from our livwire tag, to mount them as livewire parameters.
         */
        $parameter = $this->params;

        /**
         * Let the Livewire magic happen.
         */
        $lastArg = trim(last(explode(',', $expression)));

        if (Str::startsWith($lastArg, 'key(') && Str::endsWith($lastArg, ')')) {
            $cachedKey = Str::replaceFirst('key(', '', Str::replaceLast(')', '', $lastArg));
            $args      = explode(',', $expression);
            array_pop($args);
            $expression = implode(',', $args);
        } else {
            $cachedKey = "'" . Str::random(7) . "'";
        }

        if (! isset($_instance)) {
            $html = \Livewire\Livewire::mount($expression, $parameter->toArray())->html();
        } elseif ($_instance->childHasBeenRendered($cachedKey)) {
            $componentId  = $_instance->getRenderedChildComponentId($cachedKey);
            $componentTag = $_instance->getRenderedChildComponentTagName($cachedKey);
            $html         = \Livewire\Livewire::dummyMount($componentId, $componentTag);
            $_instance->preserveRenderedChild($cachedKey);
        } else {
            $response = \Livewire\Livewire::mount($expression, $parameter->toArray());
            $html     = $response->html();
            $_instance->logRenderedChild($cachedKey, $response->id(), \Livewire\Livewire::getRootElementTagName($html));
        }
        return $html;
    }

    /**
     * Loading the livewire styles in antlers style
     *
     * {{ livewire:styles }}
     */
    public function styles()
    {
        return \Livewire\Livewire::styles();
    }

    /**
     * Loading the livewire styles in antlers style
     *
     * {{ livewire:scripts }}
     */
    public function scripts()
    {
        return \Livewire\Livewire::scripts();
    }
}
