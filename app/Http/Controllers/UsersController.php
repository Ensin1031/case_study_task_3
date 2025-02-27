<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function user_subscriptions()
    {
        $users = request()->user()->user_subscriptions;
        return view('user-subscriptions', compact('users'));
    }

}
