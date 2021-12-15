<?php

namespace App\Http\Middleware;

use App\Classes\Helper;
use Closure;
use Illuminate\Http\Request;

class CheckPost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->package == 0 && Helper::countPost() >= (int)env('FREE_POST_LIMIT')) {
            return redirect()->route('plans.index');
        }
        return $next($request);
    }
}
