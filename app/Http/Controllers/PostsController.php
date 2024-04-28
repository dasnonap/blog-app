<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class PostsController extends Controller
{
    // Fetch posts

    function index(Request $request)
    {
        $posts = Post::with('user')->paginate();

        $result = (new PostCollection($posts))->toArray($request);

        return response()->json($result, 200);
    }

    // Get single post
    function edit(string $postId, Request $request)
    {
        // TO DODD
        // After setting up User REST AUTH, add check if post is created by the certain user
        $post = Post::findOrFail($postId);

        $result = (new PostResource($post))->toArray($request);

        return response()->json($result, 200);
    }

    // Create Post
    function create(Request $request)
    {
        $request->validate([
            'title' => 'required:string',
            'content' => 'required',
        ]);

        $post = new Post([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user(),
        ]);

        $post->save();

        return response()->json(['success' => true], 200);
    }
}
