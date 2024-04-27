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
            'title' => $this->title,
            'created_at' => $this->created_at->format('Y-m-d'),
            'post_info' => $this->mergeWhen($request->routeIs('posts.edit'), [
                'content' => $this->content
            ], []),
            // Listing data is only on posts.index 
            'listing_data' => $this->mergeWhen($request->routeIs('posts.index'), [
                'user' => (new UserResource($this->user))->toArray($request),
                'likes' => $this->likes,
                'dislikes' => $this->dislikes
            ], []),
        ];
    }
}
