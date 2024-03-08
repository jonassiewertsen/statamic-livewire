<?php

namespace Jonassiewertsen\Livewire\Traits;

use Livewire\Attributes\Locked;
use Statamic\Facades\Site;

trait RestoreSite
{
    #[Locked]
    public string $siteHandle = "";

    public function hydrateRestoreSite(): void
    {
        $site = Site::get($this->siteHandle);
        setlocale(LC_TIME, $site->locale());
        app()->setLocale($site->shortLocale());
    }

    protected function storeSiteHandle(): void
    {
        $this->siteHandle = Site::current()->handle();
    }
}
