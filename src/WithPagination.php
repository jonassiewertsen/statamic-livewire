<?php

namespace Jonassiewertsen\Livewire;

trait WithPagination
{
    use \Livewire\WithPagination;

    public function withPagination($key, $paginator): array
    {
        return [
            $key => $paginator->items(),
            'links' => $paginator->render(),
        ];
    }
}
