<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = auth()->user();

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'created_at' => $this->created_at->format('Y-m-d'),
            'liked' => !empty($user) ? $this->doesUserLikedPost($user) : false,
            'likes' => $this->likes_count,
            'disliked' => !empty($user) ? $this->doesUserDislikedPost($user) : false,
            'dislikes' => $this->dislikes_count,
            'author' => $this->user,
            'post_info' => $this->mergeWhen($request->routeIs('posts.edit'), [
                'content' => $this->content
            ], []),
        ];
    }
}
