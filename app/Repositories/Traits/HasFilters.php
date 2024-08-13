<?php

namespace App\Repositories\Traits;

trait HasFilters
{
    private function getAllowFilters()
    {
        $allowFilter = [
            'created_at',
            'updated_at',
        ];
        if (method_exists($this, 'canfilters')) {
            $allowFilter = array_merge($allowFilter, $this->canfilters());
        }

        return $allowFilter;
    }
}
