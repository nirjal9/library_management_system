<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
</head>
<body>
    <h1>Book Details</h1>
    <p><strong>Title:</strong> {{ $book->title }}</p>
    <p><strong>Author:</strong> {{ $book->author }}</p>
    <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
    <p><strong>Published Year:</strong> {{ $book->published_year }}</p>
    <p><strong>Description:</strong> {{ $book->description }}</p>
    <a href="{{ route('books.index') }}">Back to Book List</a>
</body>
</html>
