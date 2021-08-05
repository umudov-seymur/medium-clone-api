<?php

namespace App\Utilities\ArticleFilters;

use App\Models\User;
use App\Utilities\FilterContract;
use App\Utilities\QueryFilter;

class FavoritedFilter extends QueryFilter implements FilterContract
{
    public function handle($username): void
    {
        $this->query->whereHas('favorites', function ($q) use ($username) {
            return $q->whereUsername($username);
        });
    }
}
