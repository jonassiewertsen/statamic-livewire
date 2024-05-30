<?php

namespace Jonassiewertsen\Livewire;

use Illuminate\Http\Response;
use Livewire\Features\SupportAutoInjectedAssets\SupportAutoInjectedAssets;
use Livewire\Features\SupportScriptsAndAssets\SupportScriptsAndAssets;
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
        //
    }
}
