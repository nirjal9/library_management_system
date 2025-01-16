<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 antialiased">

    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="text-xl font-bold text-blue-500">Library Management</a>
                </div>
                <div class="flex space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-blue-500 hover:underline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-blue-500 py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold text-white">Welcome to the Library Management System</h1>
            <p class="mt-4 text-lg text-blue-100">Your one-stop solution for managing books, authors, and publishers.</p>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-2xl font-bold text-center">Features</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-bold mb-2">Manage Books</h3>
                    <p class="text-gray-700">Add, edit, and delete books in the library with ease.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-bold mb-2">Track Borrowers</h3>
                    <p class="text-gray-700">Keep track of book borrowing and returning history.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-bold mb-2">Review System</h3>
                    <p class="text-gray-700">Allow users to leave reviews for books, authors, and publishers.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Library Management System. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
