<?php

namespace App\Classes;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

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

    public static function forgetCaches($prefix)
    {
        // Increase loop if you need, the loop will stop when key not found
        for ($i=1; $i < 1000; $i++) {
            $key = $prefix . $i;
            if (Cache::has($key)) {
                Cache::forget($key);
            } else {
                break;
            }
        }
    }
}