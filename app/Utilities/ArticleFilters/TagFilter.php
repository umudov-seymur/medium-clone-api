<?php

namespace App\Utilities\ArticleFilters;

use App\Utilities\FilterContract;
use App\Utilities\QueryFilter;

class TagFilter extends QueryFilter implements FilterContract
{
    public function handle($tag_name): void
    {
        $this->query->whereHas('tags', function ($q) use ($tag_name) {
            return $q->where('name', $tag_name);
        });
    }
}
