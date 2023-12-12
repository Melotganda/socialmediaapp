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
        $sentFriendRequests = auth()->user()->sentFriendRequests;
        $receivedFriendRequests = auth()->user()->receivedFriendRequests;
        $friends = auth()->user()->friends;


        $myFriends = Friend::where(function ($query) {
            $query->where('sender_id', auth()->id())->where('status', 'accepted');
        })->orWhere(function ($query) {
            $query->where('receiver_id', auth()->id())->where('status', 'accepted');
        })->pluck('receiver_id')->toArray();

        $friendSuggestions = User::whereNotIn('id', $myFriends)->get();
        $user = Auth::user();

        $users = User::whereNotIn('id', $friends->pluck('id')->push($user->id))->where('id', '!=', $user->id)->get();

        return view('friend', compact('sentFriendRequests', 'receivedFriendRequests', 'myFriends', 'users', 'friendSuggestions'));
    }
    public function rejectRequest(Friend $friendRequest)
    {
        $friendRequest->delete();

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
