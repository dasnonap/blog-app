<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;
    use HasUuids;

    public $fillable = [
        'title',
        'content',
        'user_id',
        'slug',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userLikes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'post_user_likes');
    }

    public function userDislikes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'post_user_dislikes');
    }


    /**
     * User likes a post
     * @param User $user 
     * @return bool
     */
    public function userLikePost(User $user)
    {
        $this->load('userLikes');

        if ($this->userLikes->contains($user->id)) {
            return true;
        }

        $this->userUnDislikePost($user);

        $this->userLikes()->attach($user->id);

        $this->userSyncLikesDislikes();

        return true;
    }

    /**
     * Remove dislike for the post from a user
     * @param User $user 
     * @return bool
     */
    public function userUnDislikePost(User $user)
    {
        $this->load('userDislikes');

        if (!$this->userDislikes->contains($user->id)) {
            return true;
        }

        $this->userDislikes()->detach($user);

        $this->userSyncLikesDislikes();

        return true;
    }

    /**
     * User dislikes post
     * @param User $user
     * @return bool
     */
    public function userDislikePost(User $user)
    {
        $this->load('userDislikes');

        if ($this->userDislikes->contains($user->id)) {
            return true;
        }

        $this->userDislikes()->attach($user->id);

        $this->userSyncLikesDislikes();

        return true;
    }

    /**
     * User removes like
     * @param User $user
     * @return bool
     */
    public function userUnlikePost(User $user)
    {
        $this->load('userLikes');

        if (!$this->userLikes->contains($user->id)) {
            return true;
        }

        $this->userLikes()->detach($user);

        $this->userSyncLikesDislikes();

        return true;
    }

    /**
     * Update Likes and Dislikes Counters
     * @trigger save
     */
    public function userSyncLikesDislikes()
    {
        $this->load('userLikes', 'userDislikes');

        $this->likes_count = $this->userLikes->count();
        $this->dislikes_count = $this->userDislikes->count();

        $this->save();
    }

    /**
     * Checks if user liked a post
     * @param User $user
     * @return bool
     */
    public function doesUserLikedPost(User $user)
    {
        $this->load('userLikes');

        return $this->userLikes->contains($user->id);
    }

    /**
     * Checks if user disliked a post
     * @param User $user
     * @return bool
     */
    public function doesUserDislikedPost(User $user)
    {
        $this->load('userDislikes');

        return $this->userDislikes->contains($user->id);
    }
}
