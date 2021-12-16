<?php

namespace App\Http\Controllers;

use App\Classes\Helper;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Jobs\SendEmail;
use App\Mail\PublishedPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checkPost')->only('create', 'store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentPage = request()->get('page',1);

        if ($request->is_published == 'true') {
            $posts = cache()->remember('post-public' . $currentPage, now()->addHour(2), function () {
                return auth()->user()->posts()->where('is_published', true)->latest()->paginate(10);
            });
        } else if ($request->is_published == 'false') {
            $posts = cache()->remember('post-draft' .$currentPage, now()->addHour(2), function() {
                return auth()->user()->posts()->where('is_published', false)->latest()->paginate(10);
            });
        } else {
            $posts = cache()->remember('post-all' . $currentPage, now()->addHour(2), function () {
                return auth()->user()->posts()->latest()->paginate(10);
            });
        }

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePostRequest $request)
    {
       $post = auth()->user()->posts()->create($request->validated());

        $admins = User::where('role', 1)->get();

        foreach ($admins as $admin) {
            $this->dispatch(new SendEmail($admin, $post));
        }

        Cache::flush();

        return redirect()->route('posts.index')
            ->with('success', 'Post create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        Cache::flush();

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();

        Cache::flush();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully');
    }
}
