<?php

namespace App\Repositories\Traits;

use Spatie\QueryBuilder\QueryBuilder;

trait HasMakeBuilder
{
    private function getFields()
    {
        if (property_exists($this, 'fields')) {
            return $this->fields;
        }

        return [];
    }

    public function makeQueryBuilder(): QueryBuilder
    {
        return QueryBuilder::for($this->getModel())
            ->defaultSort($this->getDefaultSort())
            ->allowedFields($this->getFields())
            ->allowedIncludes($this->getIncludeFields())
            ->allowedFilters($this->getAllowFilters())
            ->allowedSorts($this->getAllowSorts());
    }
}
