<?php

namespace App\Repositories;

use App\Contracts\Repositories\RankServiceRepositoryInterface;
use App\Models\Rank;
use App\Models\RankService;

class RankServiceRepository extends EloquentRepository implements RankServiceRepositoryInterface
{
    public function getModel(): string
    {
        return Rank::class;
    }
}
