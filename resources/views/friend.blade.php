<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2><a href="/">Back to News Feed</a></h2>
    <div style="border: 3px solid black;">
      <h1>Friend Requests</h1>

    <h2>Sent Friend Requests</h2>
    @forelse($sentFriendRequests as $request)
    @if($request->receiver)
        <p>Sent to: {{ $request->receiver->name }}</p>
    @endif
@empty
    <p>No sent friend requests</p>
@endforelse
    <h2>Received Friend Requests</h2>
    @forelse($receivedFriendRequests as $request)
        <p>Received from: {{ $request->sender->name }}</p>
        <form method="post" action="{{ route('friend-requests.accept', ['friendRequest' => $request]) }}">
            @csrf
            <button type="submit">Accept</button>
        </form>
        <form method="post" action="{{ route('friend-requests.reject', ['friendRequest' => $request]) }}">
            @csrf
            <button type="submit">Reject</button>
        </form>
    @empty
        <p>No received friend requests</p>
    @endforelse 

    <h1>Friends</h1>
    @forelse(auth()->user()->friends as $friend)
        <p>{{ $friend->name }}</p>
    @empty
        <p>No friends yet</p>
    @endforelse
        <div style="border: 3px solid black;">
        <h2>Friend Suggestions</h2>
        <div style="background-color: gray; padding: 10px; margin: 10px">
        <h1>Friend Suggestions</h1>
    @forelse($friendSuggestions as $suggestion)
        <p>{{ $suggestion->name }} 
            <form method="post" action="{{ route('friend-requests.send', ['receiver' => $suggestion]) }}">
                @csrf
                <button type="submit">Send Friend Request</button>
            </form>
        </p>
    @empty
        <p>No friend suggestions available</p>
    @endforelse
    </div>
</body>
</html>