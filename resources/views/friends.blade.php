<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends</title>
</head>
<body>
    <h2>Add Friends</h2>
@foreach($friend_requests as $friend_request)
    <div style="background-color: gray; padding: 10px; margin: 10px"> 
        <h3>sfdfdsgsd</h3>
        @if(Auth::user() != $user && !Auth::user()->hasSentFriendRequest($user) && !Auth::user()->hasReceivedFriendRequest($user))
    <form action="{{ route('send-friend-request', $user) }}" method="post">
        @csrf
        <button type="submit">Send Friend Request</button>
    </form>
@endif
    </div>
@endforeach
</body>
</html>