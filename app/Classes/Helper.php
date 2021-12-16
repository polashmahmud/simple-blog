<?php

namespace App\Classes;

use App\Models\Post;

class Helper
{
    public static function countPost()
    {
        return auth()->user()->posts()->whereDate('created_at', today())->count();
    }

    public static function totalPost()
    {
        return Post::all()->count();
    }

    public static function totalDraftPost()
    {
        return auth()->user()->posts()->where('is_published', false)->count();
    }
}