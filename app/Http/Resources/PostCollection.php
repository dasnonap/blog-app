<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 'current_page' => $this->currentPage(),
            'data' => $this->collection->map(function ($post) use ($request) {
                return (new PostResource($post))->toArray($request);
            }),
            // 'first_page_url' => $this->url(1),
            // 'from' => $this->firstItem(),
            // 'last_page' => $this->lastPage(),
            // 'last_page_url' => $this->url($this->lastPage()),
            'next_page_url' => $this->nextPageUrl(),
            // 'path' => $this->path(),
            'per_page' => $this->perPage(),
            // 'prev_page_url' => $this->previousPageUrl(),
            'to' => $this->lastItem(),
            'total' => $this->total(),
        ];
    }
}
