<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>
<body>

@auth
<p>Congrats you are logged in</p>
<form action="/logout" method="POST">
    @csrf
    <button>Log Out</button>
</form>

<div style="border: 3px solid black;">
<h2>Create Post</h2>
<form action="/create-post" method="POST">
    @csrf
    <input type="text" name="title">
    <textarea name="body" placeholder="What's on your mind...."></textarea>
    <button>Post</button>
</form>
</div>

<div style="border: 3px solid black;">
<p><h2><a href="/friends">Friends</a></h2></p>
<h2>News Feed</h2>
@foreach($posts as $post)
    <div style="background-color: gray; padding: 10px; margin: 10px">
        <h3>{{ $post['title'] }} by {{ $post->user->name }}</h3>
        {{ $post['body'] }}
        <p><a href="/edit-post/{{ $post->id }}">Edit</a></p>

        <form method="post" action="/delete-post/{{ $post->id }}">
            @csrf
            @method('delete')
            <button type="submit">Delete</button>
        </form>
    </div>
@endforeach

</div>
@else
<div style="border: 3px solid black;">
<h2>Register</h2>
<form action="/register" method="POST">
    @csrf
    <input name="name" type="text" placeholder="Name">
    <input name="email" type="text" placeholder="Email">
    <input name="password" type="password" placeholder="Password"> 
    <button>Register</button>
</form>
</div>
<div style="border: 3px solid black;">
<h2>Log In</h2>
<form action="/login" method="POST">
    @csrf
    <input name="loginemail" type="text" placeholder="Email">
    <input name="loginpassword" type="password" placeholder="Password"> 
    <button>Log In</button>
</form>
</div>
@endauth

</body>
</html>