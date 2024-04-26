<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostsResource;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    // Fetch posts
    function index()
    {
        $posts = Post::paginate();

        dd($posts);
        dd(PostsResource::collection($posts));
    }
}
