<?php

namespace App\Repositories;

use App\Contracts\Repositories\EloquentRepositoryInterface;
use App\Repositories\Traits\HasFilters;
use App\Repositories\Traits\HasIncludes;
use App\Repositories\Traits\HasMakeBuilder;
use App\Repositories\Traits\HasSorts;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

abstract class EloquentRepository implements EloquentRepositoryInterface
{
    use HasFilters, HasIncludes, HasMakeBuilder, HasSorts;

    protected $_model;

    protected int $_paginate = 5;


    public function __construct()
    {
        $this->setModel();
    }

    private function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    abstract public function getModel(): string;

    public function getWithPagination(): LengthAwarePaginator
    {
        return $this->makeQueryBuilder()->paginate($this->_paginate);
    }

    public function store(array $data)
    {
        return $this->_model->create($data);
    }

    public function update($model, array $data)
    {
        $model->update($data);
        return $model;
    }

    public function delete($model)
    {
        return $model->delete();
    }
}
