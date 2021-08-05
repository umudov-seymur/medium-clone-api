<?php

namespace App\Utilities\ArticleFilters;

use App\Utilities\FilterContract;
use App\Utilities\QueryFilter;

class LimitFilter extends QueryFilter implements FilterContract
{
    public function handle($limit): void
    {
        $this->query->limit($limit);
    }
}
