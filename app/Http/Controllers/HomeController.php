<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(5);
        return view('welcome', compact('posts'));
    }

    public function show(Post $post) {
        return view('postShow', compact('post'));
    }
}
