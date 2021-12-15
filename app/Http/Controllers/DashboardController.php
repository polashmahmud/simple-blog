<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subscriptions = DB::table('subscriptions')
            ->where('user_id', auth()->user()->id)
            ->orderByDesc('subscriptions.updated_at')->first('id');

        return view('home', compact('subscriptions'));
    }
}
