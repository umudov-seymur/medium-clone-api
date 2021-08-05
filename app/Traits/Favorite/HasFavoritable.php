<?php

namespace App\Traits\Favorite;

use App\Models\Article;

trait HasFavoritable
{
    /**
     * Favorite the given article.
     *
     * @param Article $article
     * @return mixed
     */
    public function favorite(Article $article)
    {
        if (!$this->hasFavorite($article)) {
            return $this->favorites()->save($article);
        }
    }

    /**
     * Unfavorite the given article.
     *
     * @param Article $article
     * @return mixed
     */
    public function unFavorite(Article $article)
    {
        return $this->favorites()->detach($article);
    }

    /**
     * Get the articles favorited by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany(Article::class, 'favorites', 'user_id', 'article_id')->withTimestamps();
    }

    /**
     * Check if the user has favorited the given article.
     *
     * @param Article $article
     * @return boolean
     */
    public function hasFavorite(Article $article)
    {
        return $this->favorites->contains($article);
    }
}
