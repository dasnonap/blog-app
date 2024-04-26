<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostsResource;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    // Fetch posts

    function index(Request $request)
    {
        $posts = Post::with('user')->paginate();

        $result = (new PostCollection($posts))->toArray($request);

        return response()->json($result, 200);
    }
}
