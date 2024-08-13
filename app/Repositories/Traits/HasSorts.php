<?php

namespace App\Repositories\Traits;

trait HasSorts
{
    private function getDefaultSort()
    {
        if (property_exists($this, 'default_sort')) {
            return $this->default_sort;
        } else {
            return $this->_default_sort;
        }
    }

    private function getAllowSorts()
    {
        $allowSorts = [
            'created_at',
            'updated_at',
        ];

        if (method_exists($this, 'canSorts')) {
            $allowSorts = array_merge($allowSorts, $this->canSorts());
        }

        return $allowSorts;
    }
}
