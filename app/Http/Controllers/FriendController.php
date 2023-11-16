<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\FriendRequest;

class FriendController extends Controller
{
    public function friendScreen(){
        return view('friends');
    }
    public function sendFriendRequest(User $friend)
    {
    $user = Auth::user();

        if (!$user->hasSentFriendRequest($friend) && !$user->hasReceivedFriendRequest($friend) && $user != $friend) {
            FriendRequest::create([
                'sender_id' => $user->id,
                'receiver_id' => $friend->id,
            ]);

            return redirect()->back()->with('success', 'Friend request sent successfully.');
        }

        return redirect()->back()->with('error', 'Friend request could not be sent.');
    }

    public function acceptFriendRequest(User $friend)
    {
        $user = Auth::user();

        $friendRequest = FriendRequest::where('sender_id', $friend->id)
            ->where('receiver_id', $user->id)
            ->first();

        if ($friendRequest) {
            $friendRequest->update(['accepted' => true]);

            return redirect()->back()->with('success', 'Friend request accepted.');
        }

        return redirect()->back()->with('error', 'Friend request could not be accepted.');
    }
}

