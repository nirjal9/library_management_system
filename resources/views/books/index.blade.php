<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books List</title>
</head>
<body>
    
    <h1>Books List</h1>
    <a href="{{ route('books.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Create Book
    </a>
    
    <a href="{{ route('books.trashed') }}">View Trashed Book</a>
    <div class="mb-4">
        <a href="{{ Auth::user()->role === 'admin' ? route('dashboard') : route('user-dashboard') }}" 
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Back to Dashboard
        </a>
    </div>
    
    
    {{-- Add search functionality --}}
    <form method="GET" action="{{ route('books.index') }}">
        <input type="text" name="search" placeholder="Search by Title, Author, or ISBN" value="{{ request('search') }}">

        <!-- Availability Dropdown -->
        <select name="availability">
            <option value="">All</option>
            <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>Available</option>
            <option value="borrowed" {{ request('availability') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
        </select>

        <!-- Submit Button -->
        <button type="submit">Search</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Authors</th>
                <th>ISBN</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->authors->pluck('name')->join(', ') }}</td>

                
                <td>{{ $book->isbn }}</td>
                <td>
                    <a href="{{ route('books.show', $book->id) }}">View</a>
                    <a href="{{ route('books.edit', $book->id) }}">Edit</a>

                    <!-- Delete Form -->
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                    </form>

                    <!-- Borrow Form -->
                    @if ($book->is_borrowed)
        <form action="{{ route('books.return', $book->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Return</button>
        </form>
    @else
        <form action="{{ route('books.borrow', $book->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Borrow</button>
        </form>
                    @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

<!-- Pagination Links -->
<div class="mt-4">
    {{ $books->links('pagination::bootstrap-4') }}
</div>

</body>
</html>
