<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selamat Datang</title>
</head>
<body>
    <h1>Selamat Datang di Toko Booksales</h1>
    <p>Berikut adalah beberapa buku yang ditawarkan</p>

    @foreach ($books as $book)
        <ul>
            <li>{{ $book['author_id'] }}</li>
            <li>{{ $book['title'] }}</li>
            <li>{{ $book['description'] }}</li>
            <li>{{ $book['year'] }}</li>
        </ul>
    @endforeach
</body>
</html>