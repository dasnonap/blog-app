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

    // public function userDislikes(): BelongToMany
    // {
    // }
}
