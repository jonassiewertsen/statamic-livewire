<?php

namespace Jonassiewertsen\Livewire;

use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Livewire\Features\SupportAutoInjectedAssets\SupportAutoInjectedAssets;
use Livewire\Features\SupportScriptsAndAssets\SupportScriptsAndAssets;
use Livewire\Mechanisms\FrontendAssets\FrontendAssets;
use Statamic\StaticCaching\Replacer;

class LivewireReplacer implements Replacer
{
    public function prepareResponseToCache(Response $responseToBeCached, Response $initialResponse)
    {
        if (! $content = $responseToBeCached->getContent()) {
            return;
        }

        if (! $assets = SupportScriptsAndAssets::getAssets()) {
            return;
        }

        $assetsHead = implode('', $assets);
        $assetsBody = '';

        $responseToBeCached->setContent(
            SupportAutoInjectedAssets::injectAssets($content, $assetsHead, $assetsBody)
        );
    }

    public function replaceInCachedResponse(Response $response)
    {
        if (Str::contains($response, app(FrontendAssets::class)->scripts())) {
            return;
        }

        if (Str::contains($response, app(FrontendAssets::class)->scriptConfig())) {
            return;
        }

        app(FrontendAssets::class)->hasRenderedScripts = false;

        app('livewire')->forceAssetInjection();
    }
}
