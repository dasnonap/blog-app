<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
use App\Models\User;
use PO;

class PostsController extends Controller
{
    // Fetch posts
    function index(Request $request)
    {
        $posts = Post::with('user', 'userLikes')->paginate();

        $result = (new PostCollection($posts))->toArray($request);

        return response()->json($result, 200);
    }

    // Get single post
    function edit(string $postId, Request $request)
    {
        $post = Post::where('id', $postId)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        return response()->json(
            [
                'success' => true,
                'post' => (new PostResource($post))->toArray($request)
            ],
            200
        );
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
            'user_id' => $request->user()->id,
        ]);

        $post->save();

        return response()->json(
            [
                'success' => true,
                'post' => (new PostResource($post))->toArray($request)
            ],
            200
        );
    }

    // Update
    function update(string $postId, Request $request)
    {
        $post = Post::where('id', $postId)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $request->validate([
            'title' => 'required'
        ]);

        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();

        return response()->json(
            [
                'success' => true,
                'post' => (new PostResource($post))->toArray($request)
            ],
            200
        );
    }

    // Like
    function like(Post $post, Request $request)
    {
        $post->userLikePost(auth()->user());

        return response()->json(
            [
                'success' => true,
                'newValue' => $post->likes_count,
                'post' => (new PostResource($post))->toArray($request)
            ],
            200
        );
    }

    // Unlike
    function unlike(Post $post, Request $request)
    {
        $post->userUnlikePost(auth()->user());

        return response()->json(
            [
                'success' => true,
                'newValue' => $post->likes_count,
                'post' => (new PostResource($post))->toArray($request)
            ],
            200
        );
    }

    // Dislike
    function dislike(Post $post, Request $request)
    {
        $post->userDislikePost(auth()->user());

        return response()->json(
            [
                'success' => true,
                'newValue' => $post->dislikes_count,
                'post' => (new PostResource($post))->toArray($request)
            ],
            200
        );
    }

    // Undislike
    function undislike(Post $post, Request $request)
    {
        $post->userUnDislikePost(auth()->user());

        return response()->json(
            [
                'success' => true,
                'newValue' => $post->dislikes_count,
                'post' => (new PostResource($post))->toArray($request)
            ],
            200
        );
    }
}
