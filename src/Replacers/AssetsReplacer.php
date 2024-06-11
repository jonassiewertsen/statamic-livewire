<?php

namespace Jonassiewertsen\Livewire\Replacers;

use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Livewire\Features\SupportAutoInjectedAssets\SupportAutoInjectedAssets;
use Livewire\Features\SupportScriptsAndAssets\SupportScriptsAndAssets;
use Livewire\Mechanisms\FrontendAssets\FrontendAssets;
use Statamic\StaticCaching\Cacher;
use Statamic\StaticCaching\Cachers\NullCacher;
use Statamic\StaticCaching\Replacer;

class AssetsReplacer implements Replacer
{
    public function prepareResponseToCache(Response $responseToBeCached, Response $initialResponse)
    {
        if (! $content = $responseToBeCached->getContent()) {
            return;
        }

        // Don't disturb Livewire's assets injection when caching is off.
        if (app(Cacher::class) instanceof NullCacher) {
            return;
        }

        $assetsHead = '';
        $assetsBody = '';

        $assets = array_values(SupportScriptsAndAssets::getAssets());

        if (count($assets) > 0) {
            foreach ($assets as $asset) {
                $assetsHead .= $asset."\n";
            }
        }

        if ($this->shouldInjectLivewireAssets($initialResponse)) {
            $assetsHead .= FrontendAssets::styles()."\n";
            $assetsBody .= FrontendAssets::scripts()."\n";

            /**
             * Ensure Livewire injects its assets on the initial request.
             *
             * @see \Livewire\Features\SupportAutoInjectedAssets\SupportAutoInjectedAssets
             */
            app(FrontendAssets::class)->hasRenderedStyles = false;
            app(FrontendAssets::class)->hasRenderedScripts = false;
        }

        $responseToBeCached->setContent(
            SupportAutoInjectedAssets::injectAssets($content, $assetsHead, $assetsBody)
        );
    }

    protected function shouldInjectLivewireAssets(Response $response): bool
    {
        if (Str::contains($response, FrontendAssets::scripts())) {
            return false;
        }

        if (Str::contains($response, FrontendAssets::scriptConfig())) {
            return false;
        }

        return true;
    }

    public function replaceInCachedResponse(Response $response)
    {
        //
    }
}
