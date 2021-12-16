<?php

namespace App\Http\Controllers;

use App\Classes\Helper;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentPage = request()->get('page',1);

        $posts = cache()->remember('homepage-cache' . $currentPage, now()->addHour(2),  function () {
            return Post::with('user')
                ->where('published_at', '<=', now()->toDateTimeString())
                ->latest()
                ->paginate(5);
        });
        return view('welcome', compact('posts'));
    }

    public function show(Post $post) {
        return view('postShow', compact('post'));
    }
}
