<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function index()
    { 
        $user = Auth::user();
        $friends = $user->friends;

        $users = User::whereNotIn('id', $friends->pluck('id')->push($user->id))->where('id', '!=', $user->id)->get();


        return view('friend', compact('friends', 'users'));
    }
    public function rejectRequest(Friend $friendRequest)
    {
        $friendRequest->update(['status' => 'rejected']);

        return back();
    }
    public function sendRequest(User $receiver)
    {
        auth()->user()->sentFriendRequests()->create([
            'receiver_id' => $receiver->id,
            'status' => 'pending',
        ]);

        return back();
    }
    public function acceptRequest(Friend $friendRequest)
    {
        $friendRequest->update(['status' => 'accepted']);

        return back();
    }
    public function friendscreen(User $user, Friend $friend){
        return view('friend', ['user'=> $user]);
    }


}
