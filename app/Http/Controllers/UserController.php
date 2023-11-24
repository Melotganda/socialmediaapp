<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class Usercontroller extends Controller
{
    public function addFriend($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        Auth::user()->friends()->attach($user);

        return redirect()->back()->with('success', 'Friend request sent');
    }
    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginemail' =>'required',
            'loginpassword' =>'required'
        ]);

        if (auth()-> attempt(['email' => $incomingFields['loginemail'], 'password' => $incomingFields['loginpassword']])){

        
            $request->session()->regenerate();
    }
    return redirect('/');
}
    public function logout(){
        auth()->logout();
        return redirect('/');
    }
    public function register(Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required', 'max:16', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8','max:50'],
        ]);
        
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth() -> login($user);

        return redirect('/'); 
    }
}
