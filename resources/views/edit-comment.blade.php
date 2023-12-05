<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editcomment</title>
</head>
<body>
    <h1>Edit Comment</h1>
    <form action = "/edit-comment/{{$comment->id}}" method="POST">
        @csrf
        @method('PUT')
        <textarea name="body">{{$comment->body}}</textarea>
        <button>Save Changes</button>
</form>
</body>
</html>