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
        $this->load('tags');

        $responseArray = [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'createdAt' => $this->created_at->format('Y-m-d'),
            'liked' => !empty($user) ? $this->doesUserLikedPost($user) : false,
            'likes' => $this->likes_count,
            'disliked' => !empty($user) ? $this->doesUserDislikedPost($user) : false,
            'dislikes' => $this->dislikes_count,
            'author' => $this->user,
            'tags' => (new TagCollection($this->tags))->toArray($request),
        ];

        if ($request->routeIs('posts.edit')) {
            $responseArray = array_merge($responseArray, [
                'content' => $this->content
            ]);
        }

        return $responseArray;
    }
}
