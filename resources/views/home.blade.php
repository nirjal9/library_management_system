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
            <h1 class="text-5xl font-bold text-white">Welcome to the Library Management System</h1>
            <p class="mt-4 text-lg text-blue-100">Your one-stop solution for managing books, authors, and publishers.</p>
            <a href="{{ route('books.index') }}" class="mt-6 inline-block bg-white text-blue-500 font-bold py-2 px-4 rounded shadow hover:bg-gray-200">
                Browse Books
            </a>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Features</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-xl hover:scale-105 transition-transform duration-200">
                    <img src="https://img.freepik.com/free-vector/hand-drawn-flat-design-stack-books-illustration_23-2149341898.jpg?semt=ais_hybrid" alt="Manage Books" class="mb-4 mx-auto w-20 h-20">
                    <h3 class="text-xl font-bold mb-2">Manage Books</h3>
                    <p class="text-gray-700">Add, edit, and delete books in the library with ease.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-xl hover:scale-105 transition-transform duration-200">
                    <img src="https://media.istockphoto.com/id/1388334346/vector/hand-giving-book-exchange-books-hands-borrow-knowledge-swap-gift-reading-sharing-school.jpg?s=612x612&w=0&k=20&c=MzHxzg_lTtK4j-_PnL8-l70kY2sMXyZhdvEK7cxJPRQ=" alt="Track Borrowers" class="mb-4 mx-auto w-20 h-20">
                    <h3 class="text-xl font-bold mb-2">Track Borrowers</h3>
                    <p class="text-gray-700">Keep track of book borrowing and returning history.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-xl hover:scale-105 transition-transform duration-200">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHX9Ei2-A_GiX2KJRY6wV5ey5IiLeCUSZ80g&s" alt="Review System" class="mb-4 mx-auto w-20 h-20">
                    <h3 class="text-xl font-bold mb-2">Review System</h3>
                    <p class="text-gray-700">Allow users to leave reviews for books, authors, and publishers.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Library Management System. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
