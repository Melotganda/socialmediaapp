<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
</head>
<body>
<h2><a href="/">Back to News Feed</a></h2>
<div style="background-color: gray; padding: 10px; margin: 10px">
        <h3>{{ $post['title'] }} by {{ $post->user->name }}</h3>
        {{ $post['body'] }}
</div>

@auth
    <form method="post" action="{{ route('comments.store', $post) }}">
        @csrf
        <div>
            <label for="body">Comment:</label>
            <textarea name="body" id="body" required></textarea>
        </div>
        <button type="submit">Add Comment</button>
    </form>
@endauth
<h3><p>Comments: {{ $post->comments->count() }}</p></h3>
@foreach($post->comments as $comment)
<div style="border: 3px solid black;">
    <p>{{ $comment->user->name }}: {{ $comment->body }}</p>
    @can('delete', $comment)
        <form method="post" action="{{ route('comments.destroy', $comment) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Comment</button>
        </form>
    @endcan
    <p><a href="/edit-comment/{{ $comment->id }}">Edit</a></p>

    <form method="post" action="/comments/{{ $comment->id }}">
            @csrf
            @method('delete')
            <button type="submit">Delete</button>
        </form>
</div>
<br>
@endforeach
</body>
</html>