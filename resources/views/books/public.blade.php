<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Books</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 antialiased">

    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="text-xl font-bold text-blue-500">Library Management</a>
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Log in</a>
            </div>
        </div>
    </nav>

    <!-- Books Section -->
    <div class="container mx-auto py-12 px-4">
        <h1 class="text-3xl font-bold text-center mb-8">Available Books</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($books as $book)
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-bold mb-2">{{ $book->title }}</h2>
                    <p class="text-gray-700"><strong>Author:</strong> {{ $book->authors->pluck('name')->join(', ') }}</p>
                    <p class="text-gray-700"><strong>ISBN:</strong> {{ $book->isbn }}</p>
                    {{-- <a href="{{ route('books.show', $book->id) }}" class="text-blue-500 hover:underline">View Details</a> --}}
                </div>
            @endforeach
        </div>
    </div>
    <div class="container mx-auto text-center mt-8">
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded shadow-md" role="alert">
            <p class="font-bold">Attention!</p>
            <p>Please <a href="{{ route('login') }}" class="text-blue-600 underline hover:text-blue-800">Log in</a> to view complete book details.</p>
        </div>
    </div>
    

</body>
</html>
