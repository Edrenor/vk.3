!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    lolita
    @foreach($posts as $post)
        <a>{{ $post->text }}</a>
    @endForeach
</body>
</html>