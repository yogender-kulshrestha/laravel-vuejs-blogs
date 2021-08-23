<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostImage;
use Auth;
use Storage;

class PostController extends Controller
{
    public function getAllPosts()
    {
        $posts = Post::with('post_images')->all();
    }
}
