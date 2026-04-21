<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Author</title>
</head>
<body>
    <h1>Berikut adalah halaman author</h1>
    <p>Daftar Nama Author</p>

    @foreach ($authors as $author)
        <ul>
            <li>{{ $author['name'] }}</li>
            <li>{{ $author['email'] }}</li>
        </ul>
        
    @endforeach
    
</body>
</html>