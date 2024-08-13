<?php

namespace App\Repositories\Traits;

trait HasIncludes
{
    private function getIncludeFields()
    {
        if (property_exists($this, 'includes')) {
            return $this->includes;
        }

        return [];
    }
}
