<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function index()
    {
        $subscriptions = DB::table('subscriptions')
            ->where('user_id', auth()->user()->id)
            ->join('plans', 'subscriptions.stripe_price', '=', 'plans.stripe_plan')
            ->orderByDesc('subscriptions.updated_at')->first([
                'plans.name', 'plans.cost', 'subscriptions.trial_ends_at', 'subscriptions.ends_at',
                'subscriptions.created_at', 'subscriptions.updated_at', 'subscriptions.id',
            ]);

        return view('settings.index', compact('subscriptions'));
    }
}
