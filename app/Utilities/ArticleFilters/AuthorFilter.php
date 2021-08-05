<?php

namespace App\Utilities\ArticleFilters;

use App\Utilities\FilterContract;
use App\Utilities\QueryFilter;

class AuthorFilter extends QueryFilter implements FilterContract
{
    public function handle($username): void
    {
        $this->query->whereHas('author', function ($q) use ($username) {
            return $q->whereUsername($username);
        });
    }
}
