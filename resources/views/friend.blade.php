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
            @foreach($friends as $friend)
            <div style="border: 3px solid black;">
                <li>{{ $friend->name }}</li>
            @endforeach
    </div>
    <div style="border: 3px solid black;">
        <h2>Friend Suggestions</h2>
        <div style="background-color: gray; padding: 10px; margin: 10px">
            @foreach($users as $user)
                    {{ $user->name }}
                        <form action="{{ route('add.friend', ['id' => $user->id]) }}" method="post">
                            @csrf
                            <button type="submit">Add Friend</button>
                        </form>
            @endforeach
    </div>
</body>
</html>