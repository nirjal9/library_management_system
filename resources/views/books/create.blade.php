<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
</head>
<body>
    <h1>Add New Book</h1>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br>

        <label for="author">Author:</label>
        <input type="text" name="author" id="author" required><br>

        <label for="isbn">ISBN:</label>
        <input type="text" name="isbn" id="isbn" required><br>

        <label for="published_year">Published Year:</label>
        <input type="number" name="published_year" id="published_year" required><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea><br>

        <button type="submit">Save Book</button>
    </form>
</body>
</html>
