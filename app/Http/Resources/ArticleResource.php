<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'article';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'description' => $this->description,
            'tags' => $this->tag_list,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'favorited' => $this->favorited,
            'favorites_count' => $this->whenLoaded('favorites', function () {
                return $this->favorites()->count();
            }),
            'author' => new ProfileResource($this->author)
        ];
    }

    /**
     * Create new resource collection.
     *
     * @param  mixed  $resource
     * @return \Illuminate\Http\Resou
     * 0ces\Json\AnonymousResourceCollection
     */
    public static function collection($resource)
    {
        $collection = parent::collection($resource)->collection;
        $wrap = Str::plural(self::$wrap);

        return [
            $wrap           => $collection,
            $wrap . '_count' => $collection->count()
        ];
    }
}
