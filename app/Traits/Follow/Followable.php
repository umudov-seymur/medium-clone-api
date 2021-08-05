<?php

namespace App\Traits\Follow;

use App\Models\User;

trait Followable
{
    /**
     * Check if the authenticated user is following this user.
     *
     * @return bool
     */
    public function getFollowingAttribute()
    {
        if (!auth('sanctum')->check()) {
            return false;
        }

        return $this->followers->contains(auth('sanctum')->user());
    }

    /**
     * Follow the given user.
     *
     * @param User $user
     * @return void
     */
    public function follow(User $user)
    {
        if ($this->id != $user->id && !$this->isFollowing($user)) {
            return $this->follows()->save($user);
        }
    }

    /**
     * Unfollow the given user.
     *
     * @param User $user
     * @return void
     */
    public function unFollow(User $user)
    {
        return $this->follows()->detach($user);
    }

    /**
     * Check if a given user is following this user.
     *
     * @param User $user
     * @return bool
     */
    public function isFollowing(User $user): bool
    {
        return $this->follows->contains($user);
    }

    /**
     * Get all the users that this user is following.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }

    /**
     * Get all the users that are following this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_user_id', 'user_id');
    }
}
