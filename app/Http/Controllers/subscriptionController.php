<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class subscriptionController extends Controller
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }

    public function success(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        $subscription = DB::table('subscriptions')
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        if ($subscription->ends_at == null && $subscription->trial_ends_at == null) {
            DB::table('subscriptions')
                ->where('id', $subscription->id)
                ->update([
                    'ends_at' => Carbon::now()->addDays(30),
                ]);

            User::where('id', $user->id)->update(['package' => 1]);

        } else {
            return view('common.paymentFailed');
        }

        return view('common.paymentSuccess');
    }

    public function create(Request $request, Plan $plan)
    {
        $plan = Plan::findOrFail($request->get('plan'));

        $user = $request->user();
        $paymentMethod = $request->paymentMethod;

        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($paymentMethod);
        $user->newSubscription('default', $plan->stripe_plan)
            ->create($paymentMethod, [
                'email' => $user->email,
            ]);

        return redirect('/subscription?success=true&email=' . $user->email . '&stripe_id=' . $user->stripe_id . '&token=' . substr(md5(uniqid(rand(), true)), 16, 16));
    }

    public function createPlan()
    {
        return view('plans.create');
    }

    public function storePlan(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cost' => 'required',
        ]);

        $data = $request->except('_token');

        $data['slug'] = strtolower($data['name']);
        $price = $data['cost'] *100;

        //create stripe product
        $stripeProduct = $this->stripe->products->create([
            'name' => $data['name'],
        ]);

        //Stripe Plan Creation
        $stripePlanCreation = $this->stripe->plans->create([
            'amount' => $price,
            'currency' => 'usd',
            'interval' => 'month', //  it can be day,week,month or year
            'product' => $stripeProduct->id,
        ]);

        $data['stripe_plan'] = $stripePlanCreation->id;

        Plan::create($data);

        return redirect()->route('plans.index')->with('success', 'Plan created successfully');
    }

    public function cancel(Request $request)
    {
        $request->validate([
            'subscription_id' => 'required',
        ]);

        DB::table('subscriptions')
            ->where('id', $request->subscription_id)
            ->update([
                'ends_at' => Carbon::now(),
                'stripe_status' => 'deactivated'
            ]);

        auth()->user()->update(['package' => 0]);

        return redirect()->route('plans.index')
            ->with('success', 'Subscription cancelled successfully');
    }
}
