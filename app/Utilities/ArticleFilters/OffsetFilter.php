<?php

namespace App\Utilities\ArticleFilters;

use App\Utilities\FilterContract;
use App\Utilities\QueryFilter;

class OffsetFilter extends QueryFilter implements FilterContract
{
    public function handle($offset): void
    {
        $this->query->offset($offset);
    }
}
