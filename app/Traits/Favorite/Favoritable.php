<?php

namespace App\Traits\Favorite;

use App\Models\User;

trait Favoritable
{
    public function getFavoritedAttribute()
    {
        if (!auth('sanctum')->check()) {
            return false;
        }

        return $this->isFavorited(auth('sanctum')->user());
    }

    /**
     * The favorited that belong to the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'article_id', 'user_id')->withTimestamps();
    }

    /**
     * Check if a given user is following this user.
     *
     * @param User $user
     * @return bool
     */
    public function isFavorited(User $user): bool
    {
        return $this->favorites->contains($user);
    }
}
