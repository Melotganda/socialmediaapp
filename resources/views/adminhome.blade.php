<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>
<body>
<h1>Admin Dashboard</h1> 
@auth
<p>Congrats you are logged in</p>
<form action="/logout" method="POST">
    @csrf
    <button>Log Out</button>
</form>
@endauth
</body>
</html>