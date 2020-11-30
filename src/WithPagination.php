<?php

namespace Jonassiewertsen\Livewire;

trait WithPagination
{
    use \Livewire\WithPagination;

    public function withPagination($key, $paginator)
    {
        return [
            $key => $paginator->items(),
            'links' => $paginator->render(),
        ];
    }
}
