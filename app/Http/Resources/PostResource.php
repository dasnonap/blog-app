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
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'created_at' => $this->created_at->format('Y-m-d'),
            'liked' => $this->users->contains(auth()->user()->id),
            'likes' => $this->likes,
            'author' => $this->user,
            'dislikes' => $this->dislikes,
            'post_info' => $this->mergeWhen($request->routeIs('posts.edit'), [
                'content' => $this->content
            ], []),
        ];
    }
}
