<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
@section('content')
    <div class="container">
        <h2>Your Friends</h2>
        <ul>
            @foreach($friends as $friend)
                <li>{{ $friend->name }}</li>
            @endforeach
        </ul>

        <h2>Users</h2>
        <ul>
            @foreach($users as $user)
                <li>
                    {{ $user->name }}
                    @if(!$user->isFriend(Auth::user()))
                        <form action="{{ route('add.friend', ['id' => $user->id]) }}" method="post">
                            @csrf
                            <button type="submit">Add Friend</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endsection
</body>
</html>