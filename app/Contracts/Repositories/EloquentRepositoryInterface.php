<?php

namespace App\Contracts\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;

interface EloquentRepositoryInterface
{
    public function getWithPagination(): LengthAwarePaginator;

    public function store(array $data);

    public function update($model, array $data);

    public function delete($model);
}
