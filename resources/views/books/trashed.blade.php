<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trashed Books</title>
</head>
<body>

    {{-- Debugging output: Display the raw data --}}
    <pre>{{ print_r($books->toArray()) }}</pre>

    <h1>Trashed Books</h1>
    <a href="{{ route('books.index') }}">Back to Book List</a>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>
                        <form action="{{ route('books.restore', $book->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit">Restore</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No trashed books found.</td>
                </tr>
            @endforelse
        </tbody>
        
    </table>
</body>
</html>
