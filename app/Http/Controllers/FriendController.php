<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function friendscreen(){
        return view('friend');
    }

    public function index()
    {
        $user = Auth::user();
        $friends = $user->friends;

        return view('friend', compact('friends'));
    }
}
