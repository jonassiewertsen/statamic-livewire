<?php

namespace Jonassiewertsen\Livewire;

use Illuminate\Support\Facades\Date;
use Livewire\Attributes\Locked;
use Statamic\Facades\Site;
use Statamic\Statamic;

trait RestoreCurrentSite
{
    #[Locked]
    public string $siteHandle = '';

    public function mountRestoreCurrentSite(): void
    {
        $this->siteHandle = Site::current()->handle();
    }

    public function hydrateRestoreCurrentSite(): void
    {
        Site::setCurrent($this->siteHandle);

        $site = Site::current();

        setlocale(LC_TIME, $site->locale());
        app()->setLocale($site->lang());
        Date::setToStringFormat(Statamic::dateFormat());
    }
}
