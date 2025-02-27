<?php

namespace App\Http\Controllers;

use App\Models\UserSubscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserSubController extends Controller
{

    public function store(Request $request): RedirectResponse
    {
        $query = $request->query();
        $redirect_to = 'personal-blog';
        $parameters = [];
        if (array_key_exists("redirect_to", $query)) {
            $redirect_to = $query["redirect_to"];
        }
        if (array_key_exists("query_parameters", $query)) {
            $parameters = $query["query_parameters"];
        }

        $request->validate([
            'subscription_user_id' => 'integer',
        ]);

        $user_id = $request->user()->id;

        if (count(UserSubscription::where('user_id', $user_id)->where('subscription_user_id', $request->subscription_user_id)->get()) === 0) {
            UserSubscription::create([
                'user_id' => $user_id,
                'subscription_user_id' => $request->subscription_user_id,
            ]);
        }

        return redirect(route($redirect_to, $parameters, absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        $query = $request->query();
        $redirect_to = 'personal-blog';
        $parameters = [];
        if (array_key_exists("redirect_to", $query)) {
            $redirect_to = $query["redirect_to"];
        }
        if (array_key_exists("query_parameters", $query)) {
            $parameters = $query["query_parameters"];
        }

        $user_id = $request->user()->id;

        if ($request->has('subscription_user_id')) {
            $posts = UserSubscription::where('subscription_user_id', $request->subscription_user_id)->where('user_id', $user_id)->get();
            for ($i = 0; $i < count($posts); $i++) {
                UserSubscription::destroy($posts[$i]->id);
            }
        }

        return redirect(route($redirect_to, $parameters, absolute: false));
    }

}
