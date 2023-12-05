<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2><a href="/">Back to News Feed</a></h2>
    <div style="border: 3px solid black;">
        <h2>Your Friends</h2>
    </div>
    <div style="border: 3px solid black;">
        <h2>Friend Suggestions</h2>
        <div style="background-color: gray; padding: 10px; margin: 10px">
        @foreach($users as $user)
        {{ $user->name }}
        @if(!auth()->user()->isFriendWith($user))
    <form method="post" action="{{ route('friend-requests.send', $user) }}">
        @csrf
        <button type="submit">Send Friend Request</button>
    </form>
@endif
@if(auth()->user()->hasReceivedFriendRequestFrom($user))
    <form method="post" action="{{ route('friend-requests.accept', $user->receivedFriendRequests->first()) }}">
        @csrf
        <button type="submit">Accept Friend Request</button>
    </form>
@endif
@if(auth()->user()->hasReceivedFriendRequestFrom($user))
    <form method="post" action="{{ route('friend-requests.reject', $user->receivedFriendRequests->first()) }}">
        @csrf
        <button type="submit">Reject Friend Request</button>
    </form>
@endif
@endforeach
    </div>
</body>
</html>