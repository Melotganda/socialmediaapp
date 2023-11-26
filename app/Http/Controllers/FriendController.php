<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        $users = User::whereNotIn('id', $friends->pluck('id')->push($user->id))->where('id', '!=', $user->id)->get();


        return view('friend', compact('friends', 'users'));
    }
}
