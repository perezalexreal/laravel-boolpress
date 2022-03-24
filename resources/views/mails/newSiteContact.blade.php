<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Ecco la mail</h1>
    <ul>
        <li> <strong> Nome post: {{ $newPostInfo->tile }}</strong></li>
        <li> <strong> Author post: {{ $newPostInfo->user->name }}</strong></li>
        <li> <strong> Tags post: {{ $newPostInfo->tags }}</strong></li>
        <li> <strong> categoria post: {{ $newPostInfo->category }}</strong></li>
        <li> <strong> slug post: {{ $newPostInfo->slug }}</strong></li>
    </ul>
</body>
</html>