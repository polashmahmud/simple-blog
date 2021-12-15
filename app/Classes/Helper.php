<?php

namespace App\Classes;

use App\Models\Post;

class Helper
{
    public static function countPost()
    {
        return auth()->user()->posts()->whereDate('created_at', today())->count();
    }
}